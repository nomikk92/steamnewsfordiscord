public void SendToDiscord(const char[] message) {
    Handle request = SteamWorks_CreateHTTPRequest(k_EHTTPMethodPOST, "https://discordapp.com/api/webhooks/356427830550069251/GiczEYfFOsyEYTgSfvGWQnsYwx0Xx51tdlp4bOUGwoQ_LwxuuvpOstSHb0PDuaTv9XdI");
    
    SteamWorks_SetHTTPRequestGetOrPostParameter(request, "content", message);
    SteamWorks_SetHTTPRequestHeaderValue(request, "Content-Type", "application/x-www-form-urlencoded");
    
    if(request == null || !SteamWorks_SetHTTPCallbacks(request, Discord_Callback) || !SteamWorks_SendHTTPRequest(request)) {
        PrintToServer("[SendToSlack] SendToDiscord failed to fire");
        delete request;
    }
}

public Discord_Callback(Handle hRequest, bool bFailure, bool bRequestSuccessful, EHTTPStatusCode eStatusCode) {
    if(!bFailure && bRequestSuccessful) {
        switch (eStatusCode) {
            case 200:{
                //all gud
            }
            default: {
                PrintToServer("[Send To Discord] failed with code [%i]", eStatusCode);
                SteamWorks_GetHTTPResponseBodyCallback(hRequest, Print_Response);
            }
        }
    }
    delete hRequest;
}

public Print_Response(const char[] sData) {
    PrintToServer("[Print_Response] %s", sData);
}
