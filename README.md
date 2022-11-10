# ProunChallenge

## Symfony

Para la ejecución de este challenge se han configurado los archivos **Dockerfile** y **docker-compose.yaml** para contenerizar la aplicación.
Lo primero que debemos hacer es lanzar los servicios creados:

```shell
docker-compose up --build -d 
# Con la opción --build construiremos la imagen. 
# Con la opción -d dejaremos el proceso en segundo plano sin bloquear la termina.
```

Una vez estén corriendo los servicios procederemos a instalar las dependencias del proyecto y a realizar la migración de base de datos.

```shell
# Instalaremos las dependencias con:
docker-compose exec php-service composer install --ignore-platform-reqs

# Crearemos y ejecutaremos la migración de base de datos con:
docker-compose exec php-service bin/console doctrine:migrations:diff
docker-compose exec php-service bin/console doctrine:migrations:execute --up 'DoctrineMigrations\VersionXXXXXXXXXXXXXX'

# Generaremos la clave pública y privada del bundle LexikJWTAuthenticationBundle para la gestión de la sesión.
docker-compose exec php-service bin/console lexik:jwt:generate-keypair --overwrite
```

Con el entorno en funcionamiento podemos proceder a realizar las pruebas sobre la API.

http://localhost:30300/

### Registro de usuario e inicio de sesión para JWT.

| Ruta | Método | Parámetro 1  | Parámetro 2 |
|---|---|---|---|
| /api/signup | POST | username | password |
| /api/signin | POST | username | password |

#### Ejemplo de registro de usuario:
![Ejemplo de registro de usuario](images/img.png)

#### Ejemplo de inicio de sesión:
![Ejemplo de inicio de sesión](images/img_2.png)

### Creación y recuperación de Trip

| Ruta | Método | Ejemplo |
|---|---|---|
| /api/trip/create | POST, PUT, PATCH | {"serviceLocator": "asdfoaisr234234","collectionPoint": {"name": "Loja","latitude": 78.098,"longitude": -8.203},"destinationPoint": {"name":"Valderrubio","latitude": 150.058,"longitude": 21.007},"vehicle": "furgoneta"} |
| /api/trip/get | POST | {"uuid": "1ed61231-1f63-6fc2-81c3-cb742cfc0ec6"} |

#### Ejemplo de creación de Trip:
![Ejemplo de creación de Trip](images/img_3.png)

#### Ejemplo de recuperación de Trip:
![Ejemplo de recuperación de Trip](images/img_4.png)