<p>Dear member of <?= base_url() ?>,</p>

<p>please click the following link to confirm your new e-mail address!</p>
<p><a href="<?= base_url('register/confirm-email') . '?token=' . $hash ?>">Pease Activate your Account here. </a></p>

<p>Your auto generated password is : <?php echo $pwd; ?></p>



<p>If you didn't request this, just ignore this email.</p>