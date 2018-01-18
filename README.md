# SiteApiKey
Custom module to add the new field in Basic site setting and use that field value in URL to represent JSON output for node.

## Getting Started

* Download the module, then place this module in drupal folder structure i.e. sites/all/modules/
* Now enable this module from site administrator account.


### Requirement
Create a new custom module which will help in extending the Basic Setting Form, adding new field to that form and sote value in system variable to use further.

Also need create a URL http://localhost/page_json/{FOOBAR12345}/17 to represent the JSON output of node.

### Solution to the requirement

* A new form text field named "Site API Key" needs to be added to the "Site Information" form with the default value of “No API Key yet”.
```
We have used form_alter hook to add the new field in Basic Site Settings.
```

* When this form is submitted, the value that the user entered for this field should be saved as the system variable named "siteapikey".
```
Using form handler we have submitted the Site API Key field value, and we have used system variable to store that value.
```

* A Drupal message should inform the user that the Site API Key has been saved with that value.
```
We are showing success message using drupal_system_message()
```

* When this form is visited after the "Site API Key" is saved, the field should be populated with the correct value.
```
We have fetched the system variable value to show what was last saved in Site Api Key field.
```

* The text of the "Save configuration" button should change to "Update Configuration".
```
We have used the form_alter hook to change label.
```

* This module also provides a URL that responds with a JSON representation of a given node with the content type "page" only if the previously submitted API Key and a node id (nid) of an appropriate node are present, otherwise it will respond with "access denied".
```
To acheive this we have to add new controller to the module. URL will be like http://localhost/page_json/{FOOBAR12345}/17 where data in {} is Site Api Key.
```
