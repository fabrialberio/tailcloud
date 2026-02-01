<div align="center">
  <img src="https://raw.githubusercontent.com/fabrialberio/tailcloud/c8997b6b68ed5072a550cfbe3434fb335e94b12a/icon.svg">
</div>

## Tailcloud
Performance-optimized Nextcloud and Tailscale in a single docker-compose file.

Inspired by [this post](https://github.com/nextcloud/all-in-one/discussions/5439).

### Setup
1. [Install Docker](https://docs.docker.com/engine/install/);
2. [get a Tailscale client key](https://tailscale.com/kb/1623/trust-credentials) with scope "All - Read & Write";
3. [download the files](https://github.com/fabrialberio/tailcloud/archive/refs/heads/main.zip) or use Git to clone this repository:
```
git clone https://github.com/fabrialberio/tailcloud
```
4. create a `.env` file with the required credentials:
```env
TS_AUTH_KEY=tskey-client-***
TS_TAILNET=***.ts.net
TS_HOSTNAME=tailcloud

POSTGRES_PASSWORD=Very-Difficult-Password
POSTGRES_DB=nextclud
POSTGRES_USER=nextcloud

NEXTCLOUD_ADMIN_USER=admin
NEXTCLOUD_ADMIN_PASSWORD=Another-Difficult-Password
```
5. start all services:
```
docker compose up
```
6. after all services initialize, your Nextcloud server will show up in the Tailscale dashboard, but you will not be able to access it yet because it has no trusted domains configured;
7. stop all the services with Ctrl+C and uncomment [this line](https://github.com/fabrialberio/tailcloud/blob/6db5d0759db80c5791fd0a02661a3581cab2bb61/docker-compose.yml#L34) in `docker-compose.yml` (this has to be done after the first initialization to avoid [this error](help.nextcloud.com/t/configuration-was-not-read-or-initialized-correctly/152414));
8. start all the services again:
```
docker compose up -d
```
9. you will now be able to access your Nextcloud instance at the URL configured in `.env`.

### Performance optimizations
Before trying further performance optimizations, test your Nextcloud instance with the default settings and read the [Nextcloud server tuning documentation](https://docs.nextcloud.com/server/stable/admin_manual/installation/server_tuning.html).

**DO NOT** report issues to Nextcloud if you are not using the default PHP settings.

To configure PHP-FPM settings, uncomment [this line](https://github.com/fabrialberio/tailcloud/blob/6db5d0759db80c5791fd0a02661a3581cab2bb61/docker-compose.yml#L37) in `docker-compose.yml` and edit `php-fpm.conf`.

To configure PHP OPcache settings, uncomment [this line](https://github.com/fabrialberio/tailcloud/blob/6db5d0759db80c5791fd0a02661a3581cab2bb61/docker-compose.yml#L41) in `docker-compose.ymp` and edit `opcache.ini`.

