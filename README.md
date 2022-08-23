# Offical Adless Wordpress Plugin

This plugin offers easy integration with Adless in Wordpress.

Documentation is available at [adless.net/get-started/wordpress](https://adless.net/get-started?utm_source=wordpress&medium=oss").

## Local Development

You can test this plugin locally using docker.

To run:

`
docker compose up -d
`

Wordpress is available at [localhost](http://localhost).

At first startup, the database takes some time to initialize. If Wordpress reports errors establishing database connection, restart the Wordpress container:

`
docker compose restart wordpress
`

## Feedback

Please report issues and feature requests directly on the [GitHub issue tracker](https://github.com/adless-tech/wordpress-plugin/issues).