# TFG

## Requisitos

Para poder arrancar el proyecto es necesario contar con los siguientes programas instalados:

- Docker
- Docker Compose

## Configuración de permisos

Si se ejecuta bajo sistemas linux, es necesario dar permisos de escritura a la carpeta `www/writable`

## Arranque del Proyecto

Una vez situados en la carpeta raiz del proyecto, en un terminal lanzar:

```bash
# Arrancara los servicios en modo dettached.
docker compose up -d
```

esto se descargará las imágenes necesarias de Docker Hub y creará la imagen del webserver con Apache + PHP. El primer arranque puede tardar varios minutos, ser irá viendo el progreso en la terminal.

En los sucesivos arranques el proyecto arrancará en segundos.

## Servicios arrancados:

Una vez que arranquen los diferentes componentes, se podrá acceder a los mismos en las siguientes direcciones:

1. Acceso a [PhpMyadmin](http://localhost:8080)
2. Acceso a [Directus](http://localhost:8055). Los datos de accesos son usuario `tfg@gmail.com` y password `tfg`
3. Acceso a [Arcinema](http://localhost)