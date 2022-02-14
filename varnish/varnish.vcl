vcl 4.0;

import directors;
import std;

backend web01 {
    .host = "web01";
    .port = "80";
}

backend web02 {
    .host = "web02";
    .port = "80";
}

sub vcl_init {
    new vdir = directors.round_robin();
    vdir.add_backend(web01);
    vdir.add_backend(web02);
}

sub vcl_recv {
    set req.backend_hint = vdir.backend();
}