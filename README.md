# Akismet module for magento 2 contact form
this plugin does a simple job, if a form submited and marked as spam by akismet it will be rejected.

# important
The plugin requires akismet API key
![Scherm­afbeelding 2025-04-17 om 10 23 22](https://github.com/user-attachments/assets/285aa251-2469-49f4-8373-df8c2ccb1095)


# Installation From github
1. Create directory: `mkdir -p app/code/Wemessage/Akismet`
2. Download and copy the files from this repository to the above folder
3. Run following commands:
   ```
   bin/magento mo:en Wemessage_Akismet
   bin/magento s:up --keep-generated
   bin/magento c:c
   ```


# Installation with composer
1.  Run following commands:
   ```
   composer require wemessage/module-akismet-magento2
   bin/magento mo:en Wemessage_Akismet
   bin/magento s:up --keep-generated
   bin/magento c:c
   ```
