<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Author: Daniel Davis
*         @ourmaninjapan
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.09.2013
*
* Description:  English language file for Ion Auth example views
*
*/

// Errors
$lang['error_csrf'] = 'This form post did not pass our security checks.';

// Login
$lang['login_heading']         = 'Inloggen';
$lang['login_subheading']      = 'Login met uw e-mailadres en uw wachtwoord';
$lang['login_identity_label']  = 'E-mailadres:';
$lang['login_password_label']  = 'Wachtwoord:';
$lang['login_remember_label']  = 'Wachtwoord onthouden:';
$lang['login_submit_btn']      = 'Inloggen';
$lang['login_forgot_password'] = 'Wachtwoord vergeten?';
$lang['login_unsuccessful_not_active'] = 'Uw account is nog niet geactiveerd';

// Index
$lang['index_heading']           = 'Gebruikers';
$lang['index_subheading']        = 'Hieronder staat de lijst met gebruikers.';
$lang['index_fname_th']          = 'Voornaam';
$lang['index_lname_th']          = 'Achternaam';
$lang['index_email_th']          = 'E-mail';
$lang['index_groups_th']         = 'Groepen';
$lang['index_status_th']         = 'Status';
$lang['index_action_th']         = 'Actie';
$lang['index_active_link']       = 'Actief';
$lang['index_inactive_link']     = 'Inactief';
$lang['index_create_user_link']  = 'Maak een nieuwe user aan';
$lang['index_create_group_link'] = 'Maak een nieuwe groep aan';

// Deactivate User
$lang['deactivate_heading']                  = 'Deactiveer gebruiker';
$lang['deactivate_subheading']               = 'Weet je zeker dat je \'%s\' wilt deactiveren?';
$lang['deactivate_confirm_y_label']          = 'Ja:';
$lang['deactivate_confirm_n_label']          = 'Nee:';
$lang['deactivate_submit_btn']               = 'Verstuur';
$lang['deactivate_validation_confirm_label'] = 'Bevestig';
$lang['deactivate_validation_user_id_label'] = 'user ID';

// Create User
$lang['create_user_heading']                           = 'Maak gebruiker aan';
$lang['create_user_subheading']                        = 'Vul onderstaande velden in.';
$lang['create_user_fname_label']                       = 'Voornaam:';
$lang['create_user_lname_label']                       = 'Achternaam:';
$lang['create_user_company_label']                     = 'Bedrijfsnaam:';
$lang['create_user_email_label']                       = 'E-mail:';
$lang['create_user_phone_label']                       = 'Telefoon:';
$lang['create_user_password_label']                    = 'Wachtwoord:';
$lang['create_user_password_confirm_label']            = 'Bevestig Wachtwoord:';
$lang['create_user_submit_btn']                        = 'Maak gebruiker';
$lang['create_user_validation_fname_label']            = 'Voornaam';
$lang['create_user_validation_lname_label']            = 'Achternaam';
$lang['create_user_validation_email_label']            = 'E-mailadres';
$lang['create_user_validation_phone1_label']           = 'First Part of Phone';
$lang['create_user_validation_phone2_label']           = 'Second Part of Phone';
$lang['create_user_validation_phone3_label']           = 'Third Part of Phone';
$lang['create_user_validation_company_label']          = 'Bedrijfsnaam';
$lang['create_user_validation_password_label']         = 'Wachtwoord';
$lang['create_user_validation_password_confirm_label'] = 'Wachtwoord bevestiging';
$lang['create_user_validation_iban_number_label']      = 'IBAN nummer';

// Edit User
$lang['edit_user_heading']                           = 'Gebruiker editen';
$lang['edit_user_subheading']                        = 'Vul onderstaande velden in.';
$lang['edit_user_fname_label']                       = 'Voornaam:';
$lang['edit_user_lname_label']                       = 'Achternaam:';
$lang['edit_user_company_label']                     = 'Bedrijfsnaam:';
$lang['edit_user_email_label']                       = 'E-mail:';
$lang['edit_user_phone_label']                       = 'Telefoon:';
$lang['edit_user_password_label']                    = 'Wachtwoord: (alleen als je het wilt wijzigen)';
$lang['edit_user_password_confirm_label']            = 'Bevestig wachtwoord:';
$lang['edit_user_groups_heading']                    = 'Lid van groep';
$lang['edit_user_submit_btn']                        = 'Opslaan';
$lang['edit_user_validation_fname_label']            = 'Voornaam';
$lang['edit_user_validation_lname_label']            = 'Achternaam';
$lang['edit_user_validation_email_label']            = 'E-mailadres';
$lang['edit_user_validation_phone1_label']           = 'First Part of Phone';
$lang['edit_user_validation_phone2_label']           = 'Second Part of Phone';
$lang['edit_user_validation_phone3_label']           = 'Third Part of Phone';
$lang['edit_user_validation_company_label']          = 'Bedrijfsnaam';
$lang['edit_user_validation_groups_label']           = 'Lid van de volgende groepen';
$lang['edit_user_validation_password_label']         = 'Wachtwoord';
$lang['edit_user_validation_password_confirm_label'] = 'Wachtwoord bevestiging';

// Create Group
$lang['create_group_title']                  = 'Create Group';
$lang['create_group_heading']                = 'Create Group';
$lang['create_group_subheading']             = 'Please enter the group information below.';
$lang['create_group_name_label']             = 'Group Name:';
$lang['create_group_desc_label']             = 'Description:';
$lang['create_group_submit_btn']             = 'Create Group';
$lang['create_group_validation_name_label']  = 'Group Name';
$lang['create_group_validation_desc_label']  = 'Description';

// Edit Group
$lang['edit_group_title']                  = 'Edit Group';
$lang['edit_group_saved']                  = 'Group Saved';
$lang['edit_group_heading']                = 'Edit Group';
$lang['edit_group_subheading']             = 'Please enter the group information below.';
$lang['edit_group_name_label']             = 'Group Name:';
$lang['edit_group_desc_label']             = 'Description:';
$lang['edit_group_submit_btn']             = 'Save Group';
$lang['edit_group_validation_name_label']  = 'Group Name';
$lang['edit_group_validation_desc_label']  = 'Description';

// Change Password
$lang['change_password_heading']                               = 'Wachtwoord veranderen';
$lang['change_password_old_password_label']                    = 'Oude wachtwoord';
$lang['change_password_new_password_label']                    = 'Nieuwe wachtwoord (at least %s characters long):';
$lang['change_password_new_password_confirm_label']            = 'Bevesting wachtwoord';
$lang['change_password_submit_btn']                            = 'Wijzig';
$lang['change_password_validation_old_password_label']         = 'oude wachtwoord';
$lang['change_password_validation_new_password_label']         = 'nieuwe wachtwoord';
$lang['change_password_validation_new_password_confirm_label'] = 'bevestig wachtwoord';

// Forgot Password
$lang['forgot_password_heading']                 = 'Forgot Password';
$lang['forgot_password_subheading']              = 'Please enter your %s so we can send you an email to reset your password.';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Submit';
$lang['forgot_password_validation_email_label']  = 'Email Address';
$lang['forgot_password_username_identity_label'] = 'Username';
$lang['forgot_password_email_identity_label']    = 'Email';

// Reset Password
$lang['reset_password_heading']                               = 'Change Password';
$lang['reset_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['reset_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['reset_password_submit_btn']                            = 'Change';
$lang['reset_password_validation_new_password_label']         = 'New Password';
$lang['reset_password_validation_new_password_confirm_label'] = 'Confirm New Password';

// Activation Email
$lang['email_activate_heading']    = 'Activate account for %s';
$lang['email_activate_subheading'] = 'Please click this link to %s.';
$lang['email_activate_link']       = 'Activate Your Account';

// Forgot Password Email
$lang['email_forgot_password_heading']    = 'Reset Password for %s';
$lang['email_forgot_password_subheading'] = 'Please click this link to %s.';
$lang['email_forgot_password_link']       = 'Reset Your Password';

// New Password Email
$lang['email_new_password_heading']    = 'New Password for %s';
$lang['email_new_password_subheading'] = 'Your password has been reset to: %s';

// New image
$lang['create_image_validation_name_label']            = 'Naam van de afbeelding';
