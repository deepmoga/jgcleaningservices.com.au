<?php
$formServices = $formServices ?? get_services();
$selectedServiceId = (int) ($selectedServiceId ?? 0);
$formTitle = $formTitle ?? 'Request your free quote';
?>
<form class="quote-form" method="post" action="" novalidate data-quote-form>
    <h3><?= e($formTitle) ?></h3>
    <?php if (!empty($enquiryResult['submitted'])): ?><div class="form-message <?= $enquiryResult['success'] ? 'form-message--success' : 'form-message--error' ?>" role="status"><?= e($enquiryResult['message']) ?></div><?php endif; ?>
    <?= csrf_field() ?>
    <div class="form-honeypot" aria-hidden="true"><label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
    <div class="form-row"><label>Full name <span>*</span><input type="text" name="name" autocomplete="name" maxlength="160" required></label><label>Phone number <span>*</span><input type="tel" name="phone" autocomplete="tel" maxlength="60" required></label></div>
    <div class="form-row"><label>Email address<input type="email" name="email" autocomplete="email" maxlength="190"></label><label>Suburb<input type="text" name="suburb" autocomplete="address-level2" maxlength="140"></label></div>
    <label>Service required<select name="service_id"><option value="0">Choose a cleaning service</option><?php foreach ($formServices as $formService): ?><option value="<?= (int) $formService['id'] ?>" <?= $selectedServiceId === (int) $formService['id'] ? 'selected' : '' ?>><?= e($formService['title']) ?></option><?php endforeach; ?></select></label>
    <label>How can we help?<textarea name="message" rows="4" maxlength="5000" placeholder="Tell us about the property, preferred timing and anything important..."></textarea></label>
    <label class="form-consent"><input type="checkbox" required><span>I agree to be contacted about my cleaning enquiry.</span></label>
    <input type="hidden" name="submit_enquiry" value="1">
    <button class="btn btn--primary btn--submit" type="submit">Send My Enquiry <span aria-hidden="true">↗</span></button>
    <p class="form-note">No obligation. Your details stay private.</p>
</form>
