<?php
$footerServices = $footerServices ?? get_services();
$footerLogo = (string) setting('logo_footer', 'assets/images/footer-white-logo.png');
$whatsappNumber = preg_replace('/\D+/', '', (string) setting('whatsapp_number'));
$whatsappMessage = (string) setting('whatsapp_message');
$socials = [
    'f' => setting('social_facebook'),
    '◎' => setting('social_instagram'),
    'in' => setting('social_linkedin'),
    '▶' => setting('social_youtube'),
];
?>
<footer class="site-footer" id="contact-details">
    <div class="container">
        <div class="footer-cta">
            <div><span class="eyebrow eyebrow--light">Ready for a cleaner space?</span><h2>Let Melbourne’s cleaning professionals take care of it.</h2></div>
            <a class="btn btn--white" href="tel:<?= e(preg_replace('/\D+/', '', (string) setting('phone_1'))) ?>">Call <?= e((string) setting('phone_1')) ?> <span aria-hidden="true">↗</span></a>
        </div>
        <div class="footer-grid">
            <div class="footer-about">
                <a class="brand brand--footer" href="<?= e(url()) ?>"><img src="<?= e(asset($footerLogo)) ?>" alt="JG Cleaning Services" width="790" height="286"></a>
                <p><?= e((string) setting('footer_text')) ?></p>
                <div class="footer-socials" aria-label="Social media links">
                    <?php foreach ($socials as $label => $socialUrl): if (!$socialUrl) continue; ?>
                        <a href="<?= e((string) $socialUrl) ?>" target="_blank" rel="noopener" aria-label="Social media profile"><?= e($label) ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div><h3>Our Services</h3><ul class="footer-links">
                <?php foreach ($footerServices as $service): ?><li><a href="<?= e(url('services/' . $service['slug'])) ?>"><?= e($service['title']) ?></a></li><?php endforeach; ?>
            </ul></div>
            <div><h3>Quick Links</h3><ul class="footer-links">
                <li><a href="<?= e(url('about')) ?>">About JG Cleaning</a></li><li><a href="<?= e(url('services')) ?>">All Services</a></li><li><a href="<?= e(url('contact')) ?>">Contact &amp; Quote</a></li><li><a href="<?= e(url('privacy-policy')) ?>">Privacy Policy</a></li><li><a href="<?= e(url('admin/login.php')) ?>">Admin Login</a></li>
            </ul></div>
            <div><h3>Contact Us</h3><ul class="footer-contact">
                <li><span>Address</span><?= e((string) setting('address')) ?></li>
                <li><span>Phone</span><a href="tel:<?= e(preg_replace('/\D+/', '', (string) setting('phone_1'))) ?>"><?= e((string) setting('phone_1')) ?></a><?php if (setting('phone_2')): ?><br><a href="tel:<?= e(preg_replace('/\D+/', '', (string) setting('phone_2'))) ?>"><?= e((string) setting('phone_2')) ?></a><?php endif; ?></li>
                <li><span>Email</span><a href="mailto:<?= e((string) setting('email_1')) ?>"><?= e((string) setting('email_1')) ?></a><?php if (setting('email_2')): ?><br><a href="mailto:<?= e((string) setting('email_2')) ?>"><?= e((string) setting('email_2')) ?></a><?php endif; ?></li>
                <li><span>Opening Hours</span><?= e((string) setting('opening_hours')) ?></li>
            </ul></div>
        </div>
        <div class="footer-bottom"><p>&copy; <?= date('Y') ?> <?= e((string) setting('site_name')) ?>. All rights reserved.</p><div><a href="<?= e(url('privacy-policy')) ?>">Privacy Policy</a><a href="<?= e(url('contact')) ?>">Contact</a></div></div>
    </div>
</footer>
<?php if ($whatsappNumber !== ''): ?>
<a class="floating-whatsapp" href="https://wa.me/<?= e($whatsappNumber) ?>?text=<?= rawurlencode($whatsappMessage) ?>" target="_blank" rel="noopener" aria-label="Chat with JG Cleaning Services on WhatsApp">
    <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
    <span>WhatsApp us</span>
</a>
<?php endif; ?>
<button class="back-to-top" type="button" aria-label="Back to top">↑</button>
<script src="<?= e(asset('assets/js/main.js')) ?>" defer></script>
</body></html>
