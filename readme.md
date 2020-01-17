# Baum Festival

## Proyecto de ejemplo WordPress con Custom Post Type y Custom API Rest endpoint.

### Estructura del proyecto

El proyecto incluye toda la estructura de un proyecto wordpress, 3 Custom Post Type:
Festival, Event, Artist y un custom API REST enpoint para consultar la lista de
artistas y poder filtrarlos por eventos, todo contenido en el plugin Baum para poder
ser facilmente portada sin importar el theme. Siga los siguientes pasos para montar 
el proyecto.

1. Descargue el proyecto en el directorio raíz de su servidor. Puede usar vagrant o
docker, en eso caso colocar los archivos de configuración en la raíz de este proyecto.
2. Copie y pegue en la raíz del proyecto el archivo wp-config-sample.php
con el nombre wp-config.php y cambie los datos de conexión correspondiente a su entorno.
3. Con su entorno corriendo, conectase al servidor mysql e importe
el archivo baum.sql en la base de datos correspondiente que configuro
en el arhivo wp-config
4. En la tabla options de la base de datos ajuste los valores necesarios según si
configuro virtualhost en su entorno, las filas son: siteurl y home
5. Entre desde su navagador al virtualhost configurado en su entorno, para este
proyecto es http://baum.test si no configuro un virtualhost ingresar a
http://127.0.0.1/[nombre_del_directorio]

Para poder probar el custom endpoint haga una solicitud GET a:
http://[su_virtual_host]/wp-json/baum/v1/artist?event=[id_del_evento]
donde id_del_evento es un parametro opcional.

Autor: River Martínez rianmartinez@gmail.comk