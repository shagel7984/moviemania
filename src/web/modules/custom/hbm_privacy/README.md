# hbm_privacy
hbm_privacy module for Drupal 8.

The HBM Privacy module provides a Service (HbmPrivacyService) 
that retrieves the content of a url and shows this content on the website.

HBM Privacy Configurations:
   - Configure HBM privacy url and update privacy information manually
        -> Administration -> Configuration -> System (/admin/config/system/hbm-privacy-form)
   
   - If you dont updtae privacy information manually the hbm_privacy.module -> hbm_privacy_cron() 
     will upadte privacy information if cron is executed 
   

if the module is installed, there will be a new entry "HBM Privacy Settings" shown in admin/config -> System 

Under /admin/config/system/hbm-privacy-form the relevant data can be entered.

HBM Privacy Page Link (e.g. datenschutz) 
-> Here you have to insert the path, where the privacy information should be shown . 
(e.g. privacy -> the privacy information will be available at domain/privacy now.)

HBM Privacy Url (e.g. https://cdn.datenschutz.burda.com/ID.json) 
-> Here you have to insert the corresponding url from the cdn. The extension is .json
