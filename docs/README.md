Humhumb-Intagration in ORCA (Standard-Container)
================================================

Anmeldung
---------

Auf der Anmeldemaske werden Standardmäßig nur die weiteren Anmeldemodule
angezeigt (in unserer Konfiguration das ORCA-OAuth-Modul)

Um die klassische Anmeldemaske zu erhalten muss die Anmeldeseite mit dem
Parameter `locallogin=1` aufgerufen werden.

Keycloak Setup
--------------

1. go to Administration -> Modules and activate OAuth2 Sign-In module
2. then click configure
3. enter configuration details
    a) check enabled
    b) Api Base Url e.g. https://orcadevel.localdevel/auth/realms/orcadevel/protocol/openid-connect
    c) Auth Url e.g. https://orcadevel.localdevel/auth/realms/orcadevel/protocol/openid-connect/auth
    d) Token Url e.g. https://orcadevel.localdevel/auth/realms/orcadevel/protocol/openid-connect/token
    e) Client ID e.g. orca
    f) Client secret i.e. the corresponding secret for the client
    g) hit save


In Keycloak there has to be a client for this App. The valid redirect uri
should be set to the value shown at the bottom of the configuration view for
the oauth2 module (i.e. Redirect Uri, e.g.
https://community.orcadevel.localdevel/user/auth/external?authclient=oauth2).
