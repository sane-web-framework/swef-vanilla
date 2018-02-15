<?php $this->titleSet ('Home'); ?>

<h2><?php echo htmlentities('This is file '.__FILE__.' speaking!').'<br/>'.SWEF_STR__CRLF; ?></h2>

<div class="monospace">

  <p>Set page title to &quot;Home&quot;</p>

  <p>You can $this->notify ('This is a notification') anywhere before you $this->pull ('global.notifications')</p>

  <p>NB. if you $this->reload() [usually to prevent double POSTing data], notifications are preserved and displayed in the reloaded page.</p>

  <p>Because of this (in fact use of PHP sessions generally) HTTP endpoints are not RESTful by nature.</p>

  <p>However the REQUEST_URI ./api receives and returns JSON RESTfully using $_POST['JSON'].</p>

  <p>Try posting JSON to the API using <a href="./api-test">this form</a>.</p>

  <p>You can translate to the language configured for the application using a tag identifying the language you are translating FROM.</p>

  <p>Translation is TO the language for the current context: $this->swef->context[SWEF_COL_LANGUAGE] = <?php echo htmlentities($this->swef->context[SWEF_COL_LANGUAGE]); ?></p>

  <p>Using the language file ./app/phrases/phrases.fr</p>

  <p><em><samp>&lt;t fr&gt;Tableau de bord de SWEF&lt;/t&gt;</samp></em> becomes <ins><t fr>Tableau de bord de SWEF</t></ins></p>

  <p><em><samp>&lt;t fr&gt;Unrecognised phrase&lt;/t&gt;</samp></em> becomes <ins><t fr>Unrecognised phrase</t></ins></p>

  <p>Set SWEF_DIAGNOSTIC_MODE to true in order to collect XML file of untranslated phrases in ./app/log/untranslated.log for bulk translation; these phrases can then be added to phrases.mylanguagecode. Eventually there will be a tool for that...</p>

</div>
