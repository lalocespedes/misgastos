<?php

require INC_ROOT . '/app/routes/home.php';

require INC_ROOT . '/app/routes/auth/register.php';
require INC_ROOT . '/app/routes/auth/login.php';
require INC_ROOT . '/app/routes/auth/logout.php';
require INC_ROOT . '/app/routes/auth/activate.php';

require INC_ROOT . '/app/routes/auth/password/change.php';
require INC_ROOT . '/app/routes/auth/password/recover.php';
require INC_ROOT . '/app/routes/auth/password/reset.php';

require INC_ROOT . '/app/routes/user/profile.php';
require INC_ROOT . '/app/routes/user/all.php';

require INC_ROOT . '/app/routes/errors/404.php';

require INC_ROOT . '/app/routes/category/show.php';
require INC_ROOT . '/app/routes/category/add.php';
require INC_ROOT . '/app/routes/category/edit.php';
require INC_ROOT . '/app/routes/category/form.php';

//expenses
require INC_ROOT . '/app/routes/expenses/show.php';
require INC_ROOT . '/app/routes/expenses/add.php';
require INC_ROOT . '/app/routes/expenses/delete.php';
require INC_ROOT . '/app/routes/expenses/edit.php';
require INC_ROOT . '/app/routes/expenses/form.php';
require INC_ROOT . '/app/routes/expenses/upload.php';
require INC_ROOT . '/app/routes/expenses/report.php';
require INC_ROOT . '/app/routes/expenses/xml.php';
require INC_ROOT . '/app/routes/expenses/download.php';


//company
require INC_ROOT . '/app/routes/settings/settings.php';


//reports
require INC_ROOT . '/app/routes/reports/taxes/taxes.php';


//dashbaord
require INC_ROOT . '/app/routes/dashboard/dashboard.php';

//premium
require INC_ROOT . '/app/routes/premium/premium.php';
require INC_ROOT . '/app/routes/premium/premium_charge.php';
