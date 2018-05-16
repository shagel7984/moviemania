# hbm_privacy
hbm_privacy module for Drupal 8.

The HBM Privacy module provides a Service (HbmPrivacyService) that retrieves the content of a url 
and shows this content on the website.

HBM Privacy Configurations:
   - Configure HBM privacy url and upadte privacy information manually
        -> Administration -> Configuration -> System (/admin/config/system/hbm-privacy-form)
   
   - If you dont upate privacy information manually the hbm_privacy.module -> hbm_privacy_cron() 
     will upadte privacy information if cron is executed 
   
       
The HBM Privacy module provides a menu link /datenschutz where the content of the privacy url is shown








