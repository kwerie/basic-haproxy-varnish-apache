Basic HAProxy -> Varnish -> Apache setup.
=========================================

HAProxy with Varnish & Apache cluster.

This setup contains a HAProxy loadbalancer that sends a user to a randomly selected Varnish server each time, Varnish then redirects you to a Apache server.

Installation is ready to go and setup.

Just open a terminal window and fire the sucker up with `docker compose up -d --build`
