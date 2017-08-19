# Introduction

Code imported from https://bitbucket.org/vikseriq/ciportico

# Ciportico – Reportico library for CodeIgniter

Library for use Reportico as standalone or embedded mode on CI application.

## Overview

[Reportico](http://www.reportico.org/site/index.php) is open source report generation tool, written on PHP. It allows quickly generate stored reports using preconfigured SQL queries called *projects*.

## Projects

In Reportico terms every reports scheme called *project*. So after installation on CI user must configure project template to achieve his needs.

See [detailed guide](http://www.reportico.org/swsite/site/doc/reportico/tutorial_reportico.tutorial1.pkg.html) about setting up the project.

## Integration

Refer [Reportico documentation](http://www.reportico.org/swsite/site/doc/reportico/tutorial_reportico.manual.pkg.html) and [Yii integration demo](http://www.reportico.org/yii2/web/index.php/quickstart/gettingstarted).

### Paths
After installing *ciportico* new paths will presented in system:

`assets/reportico` contains static Reportico UI files: stylesheets, scripts and image assets.

`application/cache` used for Smarty caches. Must be writable.

`application/config/ciportico.php` configuration file for the library.

`application/controllers/reporter.php` standalone Reportico controller and ajax handler.

`application/views/repotico/` contains Smarty templates for Reportico UI.

`application/libraries/Ciportico.php` CodeIgniter wrapper for Reportico.

`application/libraries/reportico/` Reportico instance files.

`application/libraries/reportico/projects/` Contains *project* schemas. Must be writable. `admin/` is main Reportico controller and should not be removed. `tutorials/` implements demo project described in Reportico docs.

### Library configuration
Primary configuration in `application/config/ciportico.php` wraps all basic reportico settings, listed in Reportico docs.

### Standalone mode
In this mode Reportico runs as standalone script with their own UI. All queries handled over AJAX.
Default pathway for this instance is `basepath/reporter/`. So if need to run reportico on another path just rename `application/controllers/reporter.php` to appropriate CI pathway or move ciportico init code to desired controller and specify new path in `conf/ciportico.php` for key `ciportico_base`.

### Embedding mode
Embedding means rendering part of Reportico project view in existing page. Sample code to embed all Reportico UI:

``` php
<?php
$this->load->library('ciportico');
$this->ciportico->reportico->reportico_ajax_mode = true;
$this->ciportico->reportico->embedded_report = true;
$this->ciportico->reportico->execute();
?>
```
Keep in mind, that all queries still passing by runner, defined in *Standalone* section.

#### Embed a project
``` php
<?php
$this->load->library('ciportico');
// shorthand it
$rp =& $this->ciportico->reportico;
$rp->embedded_report = true;
$rp->initial_execute_mode = "EXECUTE";
// mode – output
$rp->access_mode = "REPORTOUTPUT";
$rp->initial_project = "PROJECT NAME";
$rp->initial_project_password = "provide if required";
// SQL to be executed in project space
$rp->initial_sql = "SELECT CustomerID AS Id, companyname as company, contactname as contact_name FROM customers";
// hide the report title via attribute
$rp->set_attribute("ReportTitle", "Customer List"); 
$rp->clear_reportico_session = true;
$rp->execute();
?>
```

## License
Licensed under MIT. (c) 2016 vikseriq.