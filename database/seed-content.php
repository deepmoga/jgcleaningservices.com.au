<?php
declare(strict_types=1);

$settings = [
    'site_name' => 'JG Cleaning Services',
    'site_url' => '',
    'tagline' => 'Professional Cleaning Services Across Melbourne',
    'phone_1' => '0450 785 456',
    'phone_2' => '',
    'email_1' => 'info@jgcleaningservices.com.au',
    'email_2' => '',
    'address' => 'PO BOX 1396, Clayton VIC 3169',
    'opening_hours' => 'Monday to Saturday — 8:00am to 10:00pm (Sunday closed)',
    'map_embed' => '',
    'social_facebook' => '',
    'social_instagram' => '',
    'social_linkedin' => '',
    'social_youtube' => '',
    'whatsapp_number' => '61450785456',
    'whatsapp_message' => 'Hello JG Cleaning Services, I would like a free cleaning quote.',
    'footer_text' => 'Professional, reliable cleaning for Melbourne workplaces, properties and building projects. We bring the care, equipment and attention to detail your space deserves.',
    'logo_main' => 'assets/images/main-logo.png',
    'logo_footer' => 'assets/images/footer-white-logo.png',
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => '587',
    'smtp_encryption' => 'tls',
    'smtp_username' => 'gagansngh966@gmail.com',
    'smtp_password_enc' => '',
    'smtp_from_email' => 'gagansngh966@gmail.com',
    'smtp_from_name' => 'JG Cleaning Services',
    'admin_email' => 'rana33994@gmail.com',
    'mail_enabled' => '1',
];

$pages = [
    [
        'slug' => 'home',
        'title' => 'Home',
        'nav_title' => 'Home',
        'hero_title' => 'A cleaner space. A better day.',
        'hero_subtitle' => 'Professional cleaning for offices, properties and building projects across Melbourne—delivered with reliable service and attention to every detail.',
        'content' => '<p>JG Cleaning Services provides professional, practical cleaning solutions for commercial properties, homes, building projects and specialised surfaces throughout Melbourne.</p>',
        'meta_title' => 'Best Professional Cleaning Services in Melbourne',
        'meta_keywords' => 'best cleaning services Melbourne, professional cleaners Melbourne, top cleaning company Clayton, office cleaners Melbourne, builders cleaning',
        'meta_description' => 'Choose JG Cleaning Services for professional builders, office, window, carpet, pressure and curtain cleaning across Melbourne. Request your free quote today.',
        'status' => 'published',
    ],
    [
        'slug' => 'about',
        'title' => 'About JG Cleaning Services',
        'nav_title' => 'About',
        'hero_title' => 'Professional care behind every clean.',
        'hero_subtitle' => 'A Melbourne cleaning team committed to reliable service, clear communication and results you can see.',
        'content' => <<<'HTML'
<h2>A cleaning company built around dependable service</h2>
<p>JG Cleaning Services helps Melbourne property owners, builders, office managers and local businesses maintain spaces that feel clean, healthy and ready to use. Our approach is straightforward: understand the property, agree on the right scope, arrive prepared and complete the work with care. We do not believe professional cleaning should be confusing. Clients deserve clear communication, practical recommendations and a team that respects their time and premises.</p>
<h3>Specialist cleaning for different property needs</h3>
<p>Every environment creates different cleaning challenges. Fine construction dust behaves differently from daily office soil. Window glass needs a different process from carpet fibres, exterior concrete or hanging curtains. That is why our service range covers builders cleaning, office cleaning, window cleaning, carpet cleaning, pressure cleaning and curtain cleaning. Each service is planned around the materials, access, condition and outcome required.</p>
<h3>What clients can expect from JG Cleaning Services</h3>
<ul><li>Friendly communication from the first enquiry to completion</li><li>Flexible appointments from Monday to Saturday</li><li>Careful attention to surfaces, fittings and surrounding areas</li><li>Professional equipment selected for the cleaning task</li><li>A practical focus on quality, consistency and value</li></ul>
<p>Based in Clayton and serving Melbourne, we are ready to discuss one-off projects as well as ongoing commercial cleaning requirements. Whether you are preparing a newly built property, refreshing an office, restoring exterior surfaces or arranging specialised fabric care, our goal is to make the process simple and the result worthwhile.</p>
HTML,
        'meta_title' => 'About Our Professional Melbourne Cleaning Team',
        'meta_keywords' => 'about JG Cleaning Services, professional Melbourne cleaners, trusted cleaning company Clayton',
        'meta_description' => 'Learn about JG Cleaning Services, our professional approach and our specialist cleaning solutions for Melbourne offices, properties and building projects.',
        'status' => 'published',
    ],
    [
        'slug' => 'services',
        'title' => 'Professional Cleaning Services',
        'nav_title' => 'Services',
        'hero_title' => 'The right clean for every space.',
        'hero_subtitle' => 'Explore six professional cleaning services tailored for Melbourne properties, workplaces and projects.',
        'content' => '<h2>Complete cleaning solutions across Melbourne</h2><p>Choose the service that matches your property and desired result. Our team can also combine services when a project requires more than one specialist cleaning method. Contact us if you are unsure where to begin—we will help you identify a practical scope.</p>',
        'meta_title' => 'Professional Cleaning Services Melbourne | JG Cleaning',
        'meta_keywords' => 'professional cleaning services Melbourne, builders cleaning, office cleaning, carpet cleaning, window cleaning',
        'meta_description' => 'Explore builders, office, window, carpet, pressure and curtain cleaning from JG Cleaning Services across Melbourne. Get a tailored free quote.',
        'status' => 'published',
    ],
    [
        'slug' => 'contact',
        'title' => 'Contact JG Cleaning Services',
        'nav_title' => 'Contact',
        'hero_title' => 'Let’s talk about your cleaning needs.',
        'hero_subtitle' => 'Request a free quote or speak with our friendly Melbourne cleaning team.',
        'content' => '<h2>Request a professional cleaning quote</h2><p>Tell us which service you need, where the property is located and any important details about access or timing. We will review your request and contact you to discuss the most suitable cleaning solution.</p>',
        'meta_title' => 'Contact JG Cleaning Services Melbourne',
        'meta_keywords' => 'cleaning quote Melbourne, contact professional cleaners, JG Cleaning Services phone',
        'meta_description' => 'Contact JG Cleaning Services for a free professional cleaning quote in Melbourne. Call 0450 785 456 or send your requirements online.',
        'status' => 'published',
    ],
    [
        'slug' => 'privacy-policy',
        'title' => 'Privacy Policy',
        'nav_title' => 'Privacy Policy',
        'hero_title' => 'Your privacy matters to us.',
        'hero_subtitle' => 'How JG Cleaning Services collects, uses and protects website enquiry information.',
        'content' => <<<'HTML'
<h2>Information we collect</h2><p>When you request a quote or contact us, we may collect your name, telephone number, email address, suburb, requested service and the details you choose to include in your message.</p><h2>How we use information</h2><p>We use this information to respond to enquiries, prepare cleaning quotes, arrange services, improve customer support and maintain appropriate business records. We do not sell personal information.</p><h2>Storage and security</h2><p>Reasonable technical and administrative measures are used to protect enquiry information. No internet transmission is completely risk free, so please avoid submitting unnecessary sensitive information through website forms.</p><h2>Contact</h2><p>To ask about your information or request a correction, contact JG Cleaning Services using the details shown on this website.</p>
HTML,
        'meta_title' => 'Privacy Policy | JG Cleaning Services',
        'meta_keywords' => 'JG Cleaning Services privacy policy',
        'meta_description' => 'Read the JG Cleaning Services privacy policy for website enquiries and customer information.',
        'status' => 'published',
    ],
];

$services = [
    [
        'title' => 'Builders Cleaning',
        'slug' => 'builders-cleaning',
        'short_description' => 'Detailed post-construction cleaning that removes dust, debris and marks so a new or renovated space is ready for presentation and handover.',
        'content' => <<<'HTML'
<h2>Professional builders cleaning for a confident handover</h2>
<p>Construction and renovation work can transform a property, but the final result is difficult to appreciate while fine dust, packaging, labels and trade residue remain. JG Cleaning Services provides professional builders cleaning across Melbourne to help builders, developers, property managers and owners prepare completed spaces for inspection, photography, handover or occupancy. Our work is planned around the condition of the site and the finish standard required, rather than treated like an ordinary maintenance clean.</p>
<p>Post-construction dust settles on more than floors. It collects along skirting, inside joinery, on window tracks, above doors, around fittings and across newly installed surfaces. If it is wiped incorrectly, abrasive particles may create marks or simply move from one area to another. Our team follows a systematic top-to-bottom process and uses cleaning methods appropriate for new materials. This detailed approach helps reveal the workmanship beneath the construction residue.</p>
<h3>What our builders clean can include</h3>
<ul><li>Removal of loose building dust and accessible non-hazardous debris</li><li>Detailed wiping of ledges, skirting boards, doors, frames and fixtures</li><li>Internal window glass, tracks and sill cleaning where included</li><li>Cleaning of cupboards, wardrobes, shelves and joinery interiors</li><li>Kitchen and bathroom surface cleaning, polishing and presentation</li><li>Vacuuming and mopping of floors using surface-suitable methods</li><li>Careful removal of suitable stickers, light adhesive traces and marks</li><li>Final touch-up cleaning before client inspection or photography</li></ul>
<h3>Cleaning stages tailored to the building program</h3>
<p>Some projects need one comprehensive final clean. Larger builds may benefit from staged cleaning, such as an initial removal clean followed by a detailed presentation clean after final trade attendance. We discuss timing before work begins because cleaners arriving too early can lead to freshly cleaned areas being affected by ongoing sanding, cutting or installation. Coordinating the clean with practical completion helps protect the result and reduces unnecessary repeat work.</p>
<p>Before quoting, we consider property size, number of rooms, type of construction, surface materials, access, parking, available utilities and the volume of remaining dust. We also ask whether external windows, high-level areas, pressure cleaning or carpet cleaning are required. Combining these services can create a more consistent handover result while keeping the scope clear.</p>
<h3>Why choose JG Cleaning Services after construction?</h3>
<p>Builders cleaning requires patience, organisation and respect for newly completed finishes. Our team works carefully around cabinetry, tapware, appliances, glass and painted surfaces. We focus on visible presentation as well as overlooked edges and corners that can affect an inspection. Clear communication also matters: if we notice an area that requires a specialist trade, hazardous-material handling or repair rather than cleaning, we raise it instead of taking an unsuitable approach.</p>
<h3>Preparing for your builders cleaning appointment</h3>
<ol><li>Confirm that major dust-producing work has finished.</li><li>Arrange safe access and advise us of site induction requirements.</li><li>Remove trade tools and identify anything that must remain untouched.</li><li>Provide a defect or priority-area list if the handover has special requirements.</li><li>Tell us about delicate finishes, restricted water use or power limitations.</li></ol>
<p>Whether the project is a renovated home, commercial fit-out, new office or newly constructed property, our aim is to leave it cleaner, brighter and ready for its next stage. Contact JG Cleaning Services for a tailored Melbourne builders cleaning quote based on the actual site—not a generic estimate.</p>
HTML,
        'faqs' => [
            ['question' => 'When should builders cleaning be booked?', 'answer' => 'The best time is after major dust-producing work and most trade activity are complete, but before photography, inspection or handover. We can discuss staged cleaning for larger projects.'],
            ['question' => 'Do you remove all construction waste?', 'answer' => 'We remove light, accessible and non-hazardous cleaning debris within the agreed scope. Skip waste, hazardous substances and heavy building materials require appropriate specialist disposal.'],
            ['question' => 'Can window and carpet cleaning be included?', 'answer' => 'Yes. Internal or external window cleaning and professional carpet cleaning can be included when access, condition and requirements are confirmed in the quote.'],
            ['question' => 'Do you clean newly installed cupboards and fixtures?', 'answer' => 'Yes, accessible joinery, shelves, fixtures and fittings can be detailed using methods selected for their material and condition.'],
        ],
        'meta_title' => 'Best Builders Cleaning Melbourne | Post-Construction Clean',
        'meta_keywords' => 'builders cleaning Melbourne, post construction cleaning, after builders cleaners, new build cleaning Melbourne, renovation clean',
        'meta_description' => 'Professional builders cleaning in Melbourne for new builds, renovations and fit-outs. Detailed dust removal and final presentation cleaning. Free quotes.',
        'sort_order' => 1,
    ],
    [
        'title' => 'Office Cleaning',
        'slug' => 'office-cleaning',
        'short_description' => 'Reliable commercial office cleaning tailored around your operating hours for a healthier, more organised and professional workplace.',
        'content' => <<<'HTML'
<h2>Professional office cleaning that supports a better workplace</h2>
<p>A clean office influences far more than first impressions. It supports everyday comfort, helps shared areas feel organised and gives employees and visitors confidence in the workplace. JG Cleaning Services provides professional office cleaning across Melbourne for businesses seeking reliable service, clear communication and a cleaning plan suited to the way their premises actually operate.</p>
<p>No two offices have the same traffic or priorities. A small professional suite may need weekly attention, while a busy workplace with shared kitchens, meeting rooms and customer areas may require more frequent service. We begin by discussing the layout, working hours, access arrangements, surface types and areas that need the most attention. This allows us to recommend a practical scope instead of including tasks that provide little value.</p>
<h3>Office cleaning tasks can include</h3>
<ul><li>Vacuuming carpeted work areas, meeting rooms and walkways</li><li>Mopping suitable hard floors and cleaning entrance areas</li><li>Dusting accessible desks, ledges, sills and common surfaces</li><li>Cleaning and sanitising agreed high-touch points</li><li>Kitchen, lunchroom and staff amenity cleaning</li><li>Washroom cleaning, surface disinfection and consumable checks</li><li>Emptying internal bins and replacing supplied liners</li><li>Spot cleaning internal glass, doors and visible marks</li><li>Reception and customer-facing area presentation</li></ul>
<h3>A schedule designed around your business</h3>
<p>Cleaning should not unnecessarily interrupt staff or customers. Our extended Monday-to-Saturday availability makes it easier to arrange service before opening, after working hours or during an agreed quieter period. Frequency can be adjusted as the office changes—for example, during seasonal busy periods, events, staff growth or a move to hybrid working.</p>
<p>We can also discuss periodic tasks that sit outside the regular checklist. These may include professional carpet cleaning, detailed internal window cleaning, curtain cleaning or a deeper reset of kitchens and shared spaces. Scheduling periodic work prevents the everyday service from becoming overloaded and helps maintain a more consistent standard over time.</p>
<h3>Consistency, communication and workplace care</h3>
<p>Reliable commercial cleaning depends on more than completing a list. Cleaners need to understand access, alarms, security expectations and areas where confidential documents or sensitive equipment may be present. We ask clients to identify restricted zones and follow agreed access procedures. Our team cleans around workplace property carefully and avoids moving documents or personal items unnecessarily.</p>
<p>If a recurring concern develops, such as heavy entry soil during wet weather or increased kitchen use, we can review the scope rather than allowing standards to decline. This practical communication helps the service stay aligned with the office instead of remaining fixed while the workplace changes.</p>
<h3>Benefits of a professionally maintained office</h3>
<ol><li>A welcoming environment for customers, candidates and business partners</li><li>Cleaner shared spaces for employees throughout the working week</li><li>Reduced visible dust, fingerprints, crumbs and floor soil</li><li>More consistent presentation without relying on internal staff</li><li>A cleaning schedule and priority list that can be reviewed as needed</li></ol>
<p>From offices in Clayton and surrounding suburbs to workplaces across Melbourne, JG Cleaning Services is ready to develop a professional cleaning arrangement that fits your site. Contact us with your floor area, preferred frequency and operating hours for a tailored, obligation-free quote.</p>
HTML,
        'faqs' => [
            ['question' => 'Can office cleaning be completed outside business hours?', 'answer' => 'Yes. Subject to availability and access arrangements, we can schedule cleaning before opening, after hours or during an agreed low-traffic period.'],
            ['question' => 'Do you offer regular weekly office cleaning?', 'answer' => 'Yes. We can arrange weekly or another suitable recurring schedule after reviewing the office size, traffic and required tasks.'],
            ['question' => 'Can carpet and window cleaning be added?', 'answer' => 'Yes. Periodic carpet, window and curtain cleaning can be quoted alongside regular office cleaning.'],
            ['question' => 'Will you provide a cleaning checklist?', 'answer' => 'We agree on the scope and priority areas before commencement so both parties understand what is included and how often tasks are completed.'],
        ],
        'meta_title' => 'Professional Office Cleaning Melbourne | Commercial Cleaners',
        'meta_keywords' => 'office cleaning Melbourne, commercial cleaners Melbourne, professional office cleaners Clayton, workplace cleaning services',
        'meta_description' => 'Reliable professional office cleaning across Melbourne with flexible schedules, detailed workplace care and tailored commercial cleaning plans.',
        'sort_order' => 2,
    ],
    [
        'title' => 'Window Cleaning',
        'slug' => 'window-cleaning',
        'short_description' => 'Professional interior and exterior window cleaning for clearer glass, detailed frames and a brighter-looking Melbourne property.',
        'content' => <<<'HTML'
<h2>Professional window cleaning for clearer views</h2>
<p>Clean windows can immediately improve the appearance of a home, office, shopfront or newly completed property. Natural light looks brighter, exterior presentation feels sharper and rooms appear better maintained. JG Cleaning Services provides professional window cleaning across Melbourne, with attention given not only to the centre of the glass but also to the edges, accessible sills and agreed frame or track areas.</p>
<p>Glass collects different kinds of soil depending on its location. Internal panes may show fingerprints, dust and cooking film, while exterior glass is exposed to traffic residue, rain spots, cobwebs and environmental dirt. Newly installed windows may also carry labels or construction residue. Before cleaning, we consider the glass condition, access, height, surrounding surfaces and whether any coatings or films need special care.</p>
<h3>Our window cleaning service can cover</h3>
<ul><li>Interior and exterior glass within the agreed safe-access scope</li><li>Removal of loose dust, cobwebs and everyday surface soil</li><li>Detailing of accessible edges, sills, frames and tracks when included</li><li>Cleaning of glass doors, office partitions and entry glazing</li><li>Shopfront or customer-facing window presentation</li><li>Post-construction window cleaning assessed for suitable residue removal</li><li>Spot treatment of common marks where safe and practical</li></ul>
<h3>The right method for the glass and location</h3>
<p>Professional results rely on selecting an appropriate process. Traditional applicator and squeegee methods can provide controlled detailing for many windows. Other accessible exterior areas may benefit from equipment that allows larger sections to be cleaned efficiently. We do not use aggressive scraping or chemicals without considering the glass, manufacturer guidance and risk of damage. Scratches, mineral etching, failed seals and defects inside double glazing cannot be removed through ordinary cleaning, and we explain those limitations where visible.</p>
<p>Frames and tracks can require more time than the glass itself when dirt has accumulated over a long period. For that reason, we clarify whether a quote is for glass only, glass and frames, or a more detailed track clean. This avoids unexpected differences between a quick maintenance service and a restoration-style first visit.</p>
<h3>Window cleaning for commercial properties</h3>
<p>Reception glazing, meeting-room partitions, glass doors and shopfront windows are touched frequently and can affect how customers perceive a business. We can arrange a one-off service or discuss a recurring maintenance frequency based on traffic, exposure and presentation standards. Where cleaning occurs around workstations or customer areas, we plan the order of work to reduce disruption and keep wet equipment controlled.</p>
<h3>Preparing for your window cleaning visit</h3>
<ol><li>Move small items and fragile decorations away from accessible internal sills.</li><li>Advise us about security screens, fixed furniture or restricted areas.</li><li>Identify tinted, coated, leadlight or damaged glass before work begins.</li><li>Arrange safe access to gates, balconies or rooms included in the quote.</li><li>Tell us if the windows are part of a builders clean or end-of-project handover.</li></ol>
<p>Regular window cleaning can prevent everyday grime from dominating the view and helps frames and sills receive attention before soil becomes heavily compacted. Whether you need a residential refresh, office presentation clean or detailed windows after building work, JG Cleaning Services can prepare a scope suited to your property. Contact our Melbourne team for a free quote.</p>
HTML,
        'faqs' => [
            ['question' => 'Do you clean both inside and outside windows?', 'answer' => 'Yes. Interior, exterior or combined cleaning can be quoted, subject to safe access and the agreed scope.'],
            ['question' => 'Are frames and tracks included?', 'answer' => 'They can be included. Because detailed tracks may require additional time, the quote will state whether glass, frames and tracks are covered.'],
            ['question' => 'Can you remove hard-water stains?', 'answer' => 'Some surface deposits may improve, but mineral etching can permanently alter glass. We assess the condition and explain realistic expectations before specialised treatment.'],
            ['question' => 'How often should commercial windows be cleaned?', 'answer' => 'Frequency depends on traffic, exposure and presentation needs. Customer-facing glass often benefits from more regular maintenance than sheltered windows.'],
        ],
        'meta_title' => 'Best Window Cleaning Melbourne | Professional Glass Cleaners',
        'meta_keywords' => 'window cleaning Melbourne, professional window cleaners, commercial glass cleaning, interior exterior window cleaning',
        'meta_description' => 'Professional window cleaning in Melbourne for homes, offices and shopfronts. Clearer glass, detailed edges and flexible one-off or regular service.',
        'sort_order' => 3,
    ],
    [
        'title' => 'Carpet Cleaning',
        'slug' => 'carpet-cleaning',
        'short_description' => 'Deep professional carpet cleaning designed to lift embedded soil, refresh fibres and improve the presentation of rooms and workplaces.',
        'content' => <<<'HTML'
<h2>Professional carpet cleaning for fresher interiors</h2>
<p>Carpet is comfortable and practical, but its fibres naturally collect dry soil, grit, dust and residues that ordinary surface vacuuming cannot always remove. Busy walkways become dull, spills leave visible patches and rooms can begin to feel less fresh. JG Cleaning Services provides professional carpet cleaning across Melbourne for homes, offices, rental properties and commercial spaces that need a deeper, more methodical clean.</p>
<p>The best process depends on the carpet fibre, construction, age, condition and type of soil present. Before starting, we inspect the accessible area, discuss known stains and identify concerns such as loose seams, permanent discolouration, existing damage or delicate fibres. This allows us to set realistic expectations. Cleaning can significantly improve many carpets, but it cannot reverse wear, sun fading, chemical bleaching or every permanent stain.</p>
<h3>What a professional carpet clean may include</h3>
<ul><li>Pre-inspection and discussion of priority areas or known spills</li><li>Thorough commercial vacuuming where included in the agreed process</li><li>Targeted pre-treatment of suitable spots and traffic lanes</li><li>Agitation or dwell time appropriate to the carpet and soil level</li><li>Deep extraction using suitable professional equipment</li><li>Attention to accessible edges and main walkways</li><li>Practical drying and ventilation advice after completion</li></ul>
<h3>More than simply treating visible stains</h3>
<p>Stain treatment is important, but professional carpet care should address the whole room. Dark traffic lanes often contain compacted oily soil and fine grit, not one isolated mark. Applying excessive spot chemical can create a light patch, sticky residue or colour change. Our approach uses controlled treatment and assesses the response of the carpet rather than promising that every stain will disappear.</p>
<p>Where a spill is fresh, blotting with a clean white towel and avoiding aggressive rubbing may help prevent it spreading. Strong supermarket chemicals, bleach and mixed cleaning products can permanently damage colour or create reactions that make professional treatment more difficult. Tell us what has already been used so we can choose the safest next step.</p>
<h3>Carpet cleaning for offices and commercial areas</h3>
<p>Commercial carpet often experiences concentrated wear around entrances, desks, corridors and tea points. We can plan cleaning in sections to suit access and operational needs. For recurring office clients, periodic carpet cleaning can be scheduled separately from routine vacuuming so deeper soil is addressed without disrupting the regular maintenance checklist.</p>
<h3>How to prepare for carpet cleaning</h3>
<ol><li>Pick up small items, cables, toys and loose floor-level objects.</li><li>Vacuum excessive loose debris if this is not part of the quoted service.</li><li>Identify stains and explain their likely cause and age where known.</li><li>Arrange parking or equipment access close to the property if possible.</li><li>Keep people and pets off damp carpet until it is suitable to walk on.</li><li>Use ventilation, heating or air movement according to the advice provided.</li></ol>
<p>Drying time varies with fibre type, extraction, humidity, temperature, ventilation and soil level. We avoid giving one fixed promise for every property, but we remove as much recoverable moisture as practical and provide aftercare guidance. Furniture with metal or timber feet should not be returned to damp carpet without appropriate protection because transfer marks may occur.</p>
<p>Whether you are refreshing a living area, preparing a rental, improving an office or combining carpet care with builders or window cleaning, JG Cleaning Services can tailor the scope. Contact our Melbourne team for an obligation-free professional carpet cleaning quote.</p>
HTML,
        'faqs' => [
            ['question' => 'Will every carpet stain come out?', 'answer' => 'No cleaner can responsibly guarantee every stain. Results depend on the spill, fibre, age, prior chemicals and whether the carpet has been permanently discoloured.'],
            ['question' => 'How long does carpet take to dry?', 'answer' => 'Drying varies with carpet type, weather, ventilation and room conditions. We provide practical advice after cleaning and recommend limiting traffic while carpet remains damp.'],
            ['question' => 'Do I need to move furniture?', 'answer' => 'Small and fragile items should be removed. Please discuss larger furniture during quoting so access and any movement included in the service are clear.'],
            ['question' => 'Can you clean office carpet?', 'answer' => 'Yes. We clean suitable commercial carpet and can plan work in sections or around agreed business access times.'],
        ],
        'meta_title' => 'Professional Carpet Cleaning Melbourne | Deep Carpet Clean',
        'meta_keywords' => 'carpet cleaning Melbourne, professional carpet cleaners, deep carpet cleaning, office carpet cleaning Melbourne',
        'meta_description' => 'Refresh tired carpets with professional carpet cleaning in Melbourne. Deep extraction, careful spot treatment and practical drying advice. Free quote.',
        'sort_order' => 4,
    ],
    [
        'title' => 'Pressure Cleaning',
        'slug' => 'pressure-cleaning',
        'short_description' => 'Powerful exterior cleaning for suitable driveways, paths, walls and hard surfaces, delivered with careful pressure selection and site protection.',
        'content' => <<<'HTML'
<h2>Professional pressure cleaning for exterior surfaces</h2>
<p>Outdoor areas are continually exposed to vehicle residue, tracked soil, weather, organic growth and airborne pollution. Over time, driveways, paths and walls can appear dark or uneven even when the surrounding property is well maintained. JG Cleaning Services provides professional pressure cleaning across Melbourne to refresh suitable hard surfaces and improve overall presentation.</p>
<p>Effective pressure cleaning is not simply a matter of using the highest setting. Excessive force can scar softer materials, disturb joint sand, force water behind cladding or damage aged coatings. We assess the surface, condition, drainage and nearby property before selecting equipment and technique. In some areas, a lower-pressure or chemically assisted approach may be more appropriate than aggressive blasting.</p>
<h3>Areas that may be suitable for pressure cleaning</h3>
<ul><li>Concrete driveways, parking areas and garage approaches</li><li>Paths, paved courtyards and selected outdoor entertaining areas</li><li>Suitable brickwork, masonry and retaining surfaces</li><li>Commercial entrances, loading surrounds and hardstand areas</li><li>Selected walls, fences and exterior structures after assessment</li><li>Post-construction hard-surface cleaning where appropriate</li></ul>
<h3>Site assessment and surface protection</h3>
<p>Before work begins, we look for loose mortar, cracks, failing paint, damaged pavers, fragile sealers and areas where water could enter. Existing wear can become more visible once dark surface dirt is removed, so it is important to distinguish cleaning from restoration. Pressure cleaning will not repair cracks, replace missing joint material or make weathered concrete look newly poured. It can, however, create a substantial visual improvement by removing accumulated surface contamination.</p>
<p>Nearby doors, vents, electrical fittings, plants, vehicles and customer areas also need consideration. We ask clients to close windows, clear movable items and identify drainage restrictions. Runoff is managed as practically as the site allows, and chemicals—if suitable and agreed—are selected and applied with surrounding materials in mind.</p>
<h3>A practical pressure cleaning process</h3>
<ol><li>Inspect the surface, surrounding areas and water access.</li><li>Confirm the included area and discuss permanent stains or damage.</li><li>Remove loose items and protect or avoid sensitive fixtures.</li><li>Apply an appropriate pre-treatment when required.</li><li>Clean in a controlled pattern to promote an even result.</li><li>Rinse the area and review edges, corners and visible remaining marks.</li><li>Provide drying, access or resealing recommendations where relevant.</li></ol>
<h3>When pressure cleaning supports property maintenance</h3>
<p>Exterior cleaning is useful before property photography, a commercial inspection, a home sale, an event or planned maintenance such as painting and sealing. Removing loose grime can also help owners see the true condition of the surface and identify repairs. Frequency depends on shade, trees, traffic, drainage and weather exposure; a sheltered damp path may need attention sooner than an open, sunny driveway.</p>
<p>Oil, rust, paint and deeply embedded discolouration may require specialised treatment and may not disappear completely. We discuss known stains during quoting so the proposed scope matches the likely outcome. Hazardous materials, unstable surfaces and high-risk areas are not treated as ordinary pressure cleaning work.</p>
<p>From residential driveways in Clayton to commercial entrances and hard surfaces across Melbourne, JG Cleaning Services can help restore a cleaner, brighter appearance. Send photos or arrange an assessment for a tailored pressure cleaning quote.</p>
HTML,
        'faqs' => [
            ['question' => 'Can every outdoor surface be pressure cleaned?', 'answer' => 'No. Material, age, coatings, damage and water-entry risk must be considered. We may recommend lower pressure, another method or no treatment for vulnerable areas.'],
            ['question' => 'Will pressure cleaning remove oil stains?', 'answer' => 'Fresh or light contamination may improve, but old oil can penetrate porous surfaces. Special treatment may be needed and full removal cannot always be guaranteed.'],
            ['question' => 'Do I need to clear the area first?', 'answer' => 'Please move vehicles, furniture, pots and fragile items where possible, close nearby windows and advise us about drainage or access restrictions.'],
            ['question' => 'Can pressure cleaning be combined with a builders clean?', 'answer' => 'Yes. Suitable exterior hard-surface cleaning can be quoted as part of a broader post-construction cleaning scope.'],
        ],
        'meta_title' => 'Top Pressure Cleaning Melbourne | Driveways & Hard Surfaces',
        'meta_keywords' => 'pressure cleaning Melbourne, driveway cleaning, high pressure cleaners Melbourne, concrete cleaning, exterior surface cleaning',
        'meta_description' => 'Professional pressure cleaning in Melbourne for suitable driveways, paths, walls and commercial hard surfaces. Careful methods and free quotes.',
        'sort_order' => 5,
    ],
    [
        'title' => 'Curtain Cleaning',
        'slug' => 'curtain-cleaning',
        'short_description' => 'Specialist curtain cleaning that removes settled dust and helps refresh window furnishings while respecting fabric, construction and care requirements.',
        'content' => <<<'HTML'
<h2>Professional curtain cleaning for fresher window furnishings</h2>
<p>Curtains soften a room, control light and contribute to privacy, but their fabric also holds airborne dust and everyday environmental residue. Because they hang vertically, gradual soil can be difficult to notice until colours look dull, folds feel dusty or the room no longer seems as fresh. JG Cleaning Services provides professional curtain cleaning in Melbourne, with the method considered according to fabric, lining, age, construction and manufacturer care guidance.</p>
<p>Curtains are not all made in the same way. They may contain separate linings, blackout coatings, delicate stitching, weighted hems, decorative trims or fabrics that react to moisture and heat. Some can be treated while hanging, while others may require removal and a process suited to their care label. We inspect accessible areas and discuss known damage, fading, stains and previous treatments before recommending a service.</p>
<h3>Why curtains need specialised care</h3>
<ul><li>Sun exposure can weaken fibres and create permanent colour variation</li><li>Moisture may affect linings, coatings or fabric dimensions</li><li>Heavy rubbing can distort texture or spread a local stain</li><li>Older stitching and hems may be fragile before cleaning begins</li><li>Dust can be concentrated along headings, folds and lower edges</li><li>Cooking residue or indoor smoke can require more than simple vacuuming</li></ul>
<h3>Our curtain cleaning assessment</h3>
<p>We begin by identifying the fabric where possible, checking the care label and reviewing the curtain construction. Existing water marks, mould, fibre damage or severe sun deterioration may limit the result or require a specialist restoration service. Cleaning can remove suitable surface soil and refresh appearance, but it cannot reverse UV fading, repair damaged backing or guarantee removal of every absorbed odour and stain.</p>
<p>The surrounding area also matters. Furniture, blinds, walls and flooring may need protection or access clearance. If curtains are removed, labelling and rehanging arrangements should be agreed in advance, especially where multiple panels vary in length or location. We provide a scope that explains the intended method rather than assuming one process suits every curtain.</p>
<h3>Curtain cleaning for offices and commercial interiors</h3>
<p>Window furnishings in meeting rooms, accommodation, reception areas and offices can accumulate dust without being included in regular cleaning. Periodic curtain care can form part of a wider interior refresh alongside carpet cleaning, window cleaning and detailed office cleaning. Combining services can reduce repeated access arrangements and help the entire room feel more consistently maintained.</p>
<h3>Before your curtain cleaning appointment</h3>
<ol><li>Tell us about known fabric composition, care labels and previous cleaning.</li><li>Point out stains, water damage, mould concerns or weakened sections.</li><li>Move fragile decorations and provide practical access to the curtains.</li><li>Advise whether the property has pets, smoke exposure or strong odours.</li><li>Do not apply untested spot chemicals immediately before professional cleaning.</li></ol>
<h3>Maintaining curtains between professional cleans</h3>
<p>Gentle, regular dust removal using a suitable low-suction attachment may reduce buildup, provided the fabric and heading are stable. Rooms should be ventilated appropriately, and condensation or moisture problems should be addressed because cleaning alone cannot prevent recurring mould. Handle curtains with clean hands and avoid pulling directly on delicate fabric when opening or closing them.</p>
<p>For Melbourne homes, offices and managed properties, JG Cleaning Services offers a careful starting point for curtain care. Contact us with photographs, approximate dimensions, fabric information and the number of panels. We will review the details and provide a tailored quote based on the window furnishings involved.</p>
HTML,
        'faqs' => [
            ['question' => 'Can all curtains be cleaned while hanging?', 'answer' => 'No. The appropriate method depends on fabric, lining, construction, care instructions and condition. Some curtains may need removal or a specialist process.'],
            ['question' => 'Will curtain cleaning remove mould permanently?', 'answer' => 'Cleaning may improve suitable surface contamination, but moisture and ventilation causes must be corrected or mould can return. Severely affected or damaged fabric may require replacement.'],
            ['question' => 'Can you guarantee stain and odour removal?', 'answer' => 'No. Results depend on the contaminant, fabric, age and prior treatment. We explain realistic expectations after assessment.'],
            ['question' => 'Can curtain cleaning be combined with carpet and window cleaning?', 'answer' => 'Yes. These services can be quoted together for a broader room or property refresh.'],
        ],
        'meta_title' => 'Professional Curtain Cleaning Melbourne | Fabric Care',
        'meta_keywords' => 'curtain cleaning Melbourne, professional curtain cleaners, drape cleaning Melbourne, office curtain cleaning',
        'meta_description' => 'Professional curtain cleaning in Melbourne with careful fabric assessment, practical methods and honest stain expectations. Request a tailored quote.',
        'sort_order' => 6,
    ],
];

return compact('settings', 'pages', 'services');

