Basic HAProxy -> Varnish -> Apache setup.
=========================================

Installation is ready to go and setup.

Just open a terminal window and fire the sucker up with `docker compose up -d`

Does not include SSL support, if you'd like this you will have to implement it manually. If done, you can commit to a feature/SSL-support branch.

*Note* this setup is basic and not secure.


HAProxy
=======

Balance options:

- roundrobin: each server is used in turns
- static-rr: similar to roundrobin, but it has no matter if you change the weight of a server
- leastconn: chooses a server that has the least amount of connections
- first: chooses the first server that provides a connection
- source: source IP address is hashed and divides by the total weight of the running srevers,
  this will redirect the user to the same server (while navigating between webpages etc.).
  this won't change unless a server goes down or up
- uri: you can redirect a user to a different backend if the user provides a special uri
- url_param: the URL parameter specified in argument will be looked up in the query string of each HTTP GET request.
- random: the user will be redirected to a random server
- rdp-cookie: The RDP cookie <name> (or "mstshash" if omitted) will be looked up and hashed for each incoming TCP 
  request. Just as with the equivalent ACL 'req_rdp_cookie()' function, the name is not case-sensitive. This mechanism 
  is useful as a degraded persistence mode, as it makes it possible to always send the
  same user (or the same session ID) to the same server. If the cookie is not found, the normal roundrobin algorithm is
  used instead.

More info on HAProxy (more in-depth info on balance options etc.) can be found 
[here](http://cbonte.github.io/haproxy-dconv/2.5/configuration.html)

Varnish
========

If you'd like to rename the web01, web02 & web03 names; don't forget to change them in the varnish.vcl files as well.

Varnish01 redirects to web01, varnish02 to web02 & varnish03 to web03.

Don't edit the rest of the varnish.vcl files.

The varnish documentation can be found [here](http://varnish-cache.org/docs/index.html)

Apache (php7.4-apache)
======================

**Don't edit the `ca-security.conf` file!**

If you have changed the names of the webXX directories and names, you'll have to edit them in the vhost.conf as well. If you don't do this, the web cluster won't work.

The `/src` folder is all yours, you can do whatever you'd like with this.

Installing additional PHP modules, add PHP modules in the `Dockerfile` file.
Keep in mind that you'll have to add them for each environment individually.
