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
    <svg aria-hidden="true" viewBox="0 0 32 32"><path d="M16 3A12.5 12.5 0 0 0 5.2 21.8L3.5 28.5l6.9-1.6A12.5 12.5 0 1 0 16 3Zm0 22.7c-2 0-3.9-.6-5.5-1.6l-.4-.2-4.1 1 1.1-4-.3-.4A10.1 10.1 0 1 1 16 25.7Zm5.6-7.6c-.3-.2-1.8-.9-2.1-1-.3-.1-.5-.2-.7.2l-1 1.2c-.2.2-.4.2-.7.1-2-.9-3.3-1.8-4.6-4-.4-.6.4-.6 1.1-1.8.1-.2 0-.4 0-.6l-.9-2.1c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.6.1-.9.4-1 1.1-1.4 2.3-1.4 3.7 0 2.2 1.6 4.3 1.8 4.6.2.3 3.1 4.8 7.6 6.7 2.7 1.1 3.7 1.2 5 .8.8-.1 1.8-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4Z"/></svg>
    <span>WhatsApp us</span>
</a>
<?php endif; ?>
<button class="back-to-top" type="button" aria-label="Back to top">↑</button>
<script src="<?= e(asset('assets/js/main.js')) ?>" defer></script>
</body></html>

