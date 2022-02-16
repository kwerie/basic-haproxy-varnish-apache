vcl 4.0;

# Default backend definition. Set this to point to your content server.
backend default {
   .host = "web01"; # Docker container name
   .port = "80"; # Do not change
}

sub vcl_recv {
    # Set X-Forwarded-For header correctly
    if (req.http.x-forwarded-for) {
        set req.http.X-Forwarded-For = regsub(req.http.X-Forwarded-For, "(,.*)$","");
    }

    # Check if request is valid
    if (req.method != "GET" &&
      req.method != "HEAD" &&
      req.method != "PUT" &&
      req.method != "POST" &&
      req.method != "TRACE" &&
      req.method != "OPTIONS" &&
      req.method != "DELETE") {
        /* Non-RFC2616 or CONNECT which is weird. */
        return (pipe);
    }

    # Only cache GET requests, everything else is passed
    if (req.method != "GET" && req.method != "HEAD") {
        /* We only deal with GET and HEAD by default */
        return (pass);
    }

    # if Auth is set, we cannot cache
    if (req.http.Authorization) {
        /* Not cacheable by default */
        return (pass);
    }

    /* Default install condition: pass everything else as well, this should contain rules for specific apps later on. */
    /* return (hash); */
    return (pass);
}

sub vcl_hash {
    hash_data(req.url);
    if (req.http.host) {
        hash_data(req.http.host);
    } else {
        hash_data(server.ip);
    }

    // Add the global accept type as hash key to distinguish json and html
    if(req.http.Accept ~ "json") {
        hash_data("json");
    } else {
        hash_data("html");
    }

    return (lookup);
}

sub vcl_backend_response {
    if (beresp.status != 301 && beresp.status != 302) {
        set beresp.ttl = 24h;
    }

    if(beresp.status == 301 || beresp.status == 302) {
        set beresp.ttl = 0s;
    }

    return (deliver);
}

sub vcl_deliver {
    unset resp.http.X-Req-Host;
    unset resp.http.X-Req-URL;
    unset resp.http.X-Req-URL-Base;

    unset resp.http.Via;
    unset resp.http.X-Pingback;
    unset resp.http.X-Varnish;

    return (deliver);
}

sub vcl_synth {
    if (resp.status == 301 || resp.status == 302) {
        set resp.http.Location = resp.reason;
        set resp.status = 302;

        return(deliver);
    }

    return (deliver);
}