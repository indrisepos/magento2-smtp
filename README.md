# Magento2 SMTP extension by Abzer

## How to Install?

Method 1: Download the files at https://github.com/abzertech/magento2-smtp. 
Paste it under <i><magento_project_path>/app/code/</i> and run the following command.

<code>php bin/magento setup:upgrade</code>

Method 2: Install via composer [Recommend]
Run the following commands Magento root folder

<code>composer config repositories.abzertech.smtp git git@github.com:indrisepos/magento2-smtp.git</code>

<code>composer require abzertech/smtp</code>

<code>php bin/magento setup:upgrade</code>

## How to Enable?

After installation, you can find an option to enable the extension at Stores > Configuration > ABZER EXTENSIONS >
SMTP. Enable the extension and clear cache.
