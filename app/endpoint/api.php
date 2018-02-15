<?php


// Configuration
$output                     = new \stdClass ();
$output->sessionCookie      = session_name ();
$output->sessionId          = session_id ();
$output->wasLoggedIn        = SWEF_BOOL_TRUE && $this->swef->userLoggedIn ();
$done                       = SWEF_BOOL_FALSE;
$diagnostic                 = array ();


// Input loading and validation
$input                      = null;
if (array_key_exists(SWEF_API_POST_KEY,$_POST)) {
    $input                  = json_decode (trim($_POST[SWEF_API_POST_KEY]),SWEF_BOOL_FALSE,SWEF_API_JSON_DEPTH);
}
if (!$input) {
    $output->error          = 'POST['.SWEF_API_POST_KEY.']: ';
    $output->error         .= $this->swef->translate ('This must be a valid JSON object');
    $output->POST           = $_POST;
}


// Log in
if ($input && property_exists($input,SWEF_COL_EMAIL) && property_exists($input,SWEF_STR_PASSWORD)) {
    $done                   = SWEF_BOOL_TRUE;
    if (!$this->swef->userLogin($input->{SWEF_COL_EMAIL},$input->{SWEF_STR_PASSWORD})) {
        $output->error      = $this->swef->translate ('Login failed');
    }
}


// Log out
if ($input && property_exists($input,SWEF_STR_LOGOUT) && $input->{SWEF_STR_LOGOUT}) {
    $done                   = SWEF_BOOL_TRUE;
    $this->swef->userLogout ();
}


// Run procedures
if ($input && property_exists($input,SWEF_STR_PROCEDURES) && is_array($input->{SWEF_STR_PROCEDURES})) {
    $done                               = SWEF_BOOL_TRUE;
    $output->{SWEF_STR_RESULTS}         = new \stdClass ();
    if (!count($input->{SWEF_STR_PROCEDURES})) {
        $this->notify ($this->swef->translate('No procedures were requested'));
    }
    $output->{SWEF_STR_RESULTS} = array ();
    foreach ($input->{SWEF_STR_PROCEDURES} as $i=>$proc) {
        $args                           = $proc;
        $data                           = $this->swef->apiResult ($args);
        $proc                           = array_shift ($args);
        $result                         = new \stdClass ();
        $result->{SWEF_STR_PROCEDURE}   = $proc;
        $result->{SWEF_STR_ARGS}        = $args;
        $result->{SWEF_STR_STATUS}      = $this->swef->apiStatus;
        if ($this->swef->apiStatus!=SWEF_HTTP_STATUS_CODE_200){
            $result->{SWEF_STR_ERROR}   = $this->swef->apiError;
            if ($this->swef->apiNotice) {
                $result->{SWEF_STR_ERROR}  .= SWEF_STR__SPACE.'('.$this->swef->translate('see notices').')';
                $this->notify ('Process failed - '.$this->swef->apiNotice);
            }
        }
        else {
            $result->{SWEF_STR_DATA}    = $data;
        }
        $output->{SWEF_STR_RESULTS}[$i] = $result;
        if ($proc==SWEF_CALL_APIOPTIONS) {
            $info = $this->swef->translate('Log in with this').': ';
            $this->notify ($info.'{ email:"some@email",password:"somePwd" }');
            $info = $this->swef->translate('Log out with this').': ';
            $this->notify ($info.'{ logout:true }');
        }
    }
}
else {
    $this->notify ($this->swef->translate('No procedures were requested'));
}


// Nothing happened
if (!$done) {
    $this->notify ($this->swef->translate('Had nothing to do'));
}



// Diagnostic
$output->isLoggedIn         = SWEF_BOOL_TRUE && $this->swef->userLoggedIn ();
$output->done               = $done;
$output->notices            = $this->notes ();
if (SWEF_DIAGNOSTIC) {
    array_push ($diagnostic,SWEF_COL_USERGROUPS.': '.implode(',',$this->swef->user->membershipsDescribe()));
    array_push ($diagnostic,'See table swef_config_input for input validation filtering');
    $output->diagnostic     = $diagnostic;
}

// Store output in framework
$this->swef->apiResponse    = $output;


?>
