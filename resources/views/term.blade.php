<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions - GyaanGhar</title>
    <meta name="description" content="Read the GyaanGhar Terms and Conditions. Understand the rules and guidelines for using our educational platform, services, and content.">

    <link rel="canonical" href="{{ url('/terms-and-conditions') }}" />
    <meta property="og:title" content="Terms and Conditions - GyaanGhar" />
    <meta property="og:description" content="Read the GyaanGhar Terms and Conditions. Understand the rules and guidelines for using our educational platform, services, and content." />
    <meta property="og:url" content="{{ url('/terms-and-conditions') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://i.ibb.co/Mkr5YDHV/Whats-App-Image-2025-05-14-at-23-46-30_70cce24f.jpg" /> {{-- Using a relevant general image --}}
    <link rel="icon" href="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" type="image/x-icon">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .content-section p, .content-section li {
            line-height: 1.75; /* Increased line height for readability */
            margin-bottom: 1rem; /* Consistent paragraph spacing */
        }
        .content-section h2 {
            font-size: 1.5rem; /* 24px */
            font-weight: 600; /* semibold */
            color: #1f2937; /* gray-800 */
            margin-top: 2rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb; /* gray-200 */
            padding-bottom: 0.5rem;
        }
        .content-section h3 {
            font-size: 1.25rem; /* 20px */
            font-weight: 600; /* semibold */
            color: #374151; /* gray-700 */
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }
        .content-section strong {
            color: #111827; /* gray-900 */
        }
        .content-section ul {
            list-style-type: disc;
            padding-left: 1.5rem;
        }
         /* Ensure Phosphor icons inherit text color if not set explicitly */
        [class^="ph-"] {
            vertical-align: middle; /* Better alignment with text */
        }
    </style>

    @php
        // --- Schema.org Data Preparation ---
        $siteBaseUrl = rtrim(url('/'), '/');
        $pageFullUrl = url('/terms-and-conditions'); // Specific URL

        $organizationSchema = [
            '@type' => 'Organization',
            '@id' => $siteBaseUrl . '#organization',
            'name' => 'GyaanGhar',
            'url' => $siteBaseUrl,
            'logo' => 'https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png',
            'description' => 'GyaanGhar is the ultimate platform for personalized learning and seamless access to educational resources.',
        ];

        $termsPageSchema = [
            '@type' => 'WebPage', // Could also use a more specific type like 'ServiceTermsPage' if available and appropriate
            '@id' => $pageFullUrl . '#webpage',
            'url' => $pageFullUrl,
            'name' => 'Terms and Conditions - GyaanGhar',
            'description' => "Read the GyaanGhar Terms and Conditions. Understand the rules and guidelines for using our educational platform, services, and content.",
            'isPartOf' => ['@id' => $siteBaseUrl . '#organization'],
            'publisher' => ['@id' => $siteBaseUrl . '#organization'],
            'mainEntity' => [
                '@type' => 'WebContent', // Or CreativeWork
                'headline' => 'GyaanGhar Platform Terms and Conditions',
                 // 'text' => "Full text of T&C could go here for schema if needed."
            ],
            'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $siteBaseUrl],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Terms & Conditions']
                ]
            ]
        ];

        $finalSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                $organizationSchema,
                $termsPageSchema
            ]
        ];
    @endphp
    <script type="application/ld+json">
    @json($finalSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
    </script>

</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 sm:py-4 flex justify-between items-center">
            <a href="/" class="flex items-center">
                <img src="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" alt="GyaanGhar Logo" class="h-9 sm:h-10 mr-2">
                <span class="text-xl sm:text-2xl font-bold text-blue-700 hover:text-blue-800 transition duration-300">GyaanGhar</span>
            </a>
            <nav class="flex items-center space-x-2 sm:space-x-4">
                 <a href="javascript:history.back()" class="text-xs sm:text-sm font-medium text-gray-600 hover:text-blue-700 transition duration-150 inline-flex items-center group px-2 py-1.5 rounded-md hover:bg-gray-100">
                    <ph-arrow-left size="16" weight="bold" class="sm:mr-1 transform group-hover:-translate-x-0.5 transition-transform"></ph-arrow-left>
                    <span class="hidden sm:inline">Back</span>
                </a>
                <a href="/" class="text-xs sm:text-sm font-medium text-gray-600 hover:text-blue-700 transition duration-150 inline-flex items-center group px-2 py-1.5 rounded-md hover:bg-gray-100">
                     <ph-house size="16" weight="bold" class="sm:mr-1"></ph-house>
                    <span class="hidden sm:inline">Home</span>
                </a>
            </nav>
        </div>
    </header>

    <main class="py-12 sm:py-16">
        <!-- Hero Section for Terms & Conditions -->
        <div class="bg-gradient-to-br from-purple-50 via-indigo-50 to-blue-50 py-16 sm:py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <ph-file-text size="64" weight="duotone" class="text-purple-600 mx-auto mb-4"></ph-file-text>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 tracking-tight">
                    Terms and Conditions
                </h1>
                <p class="mt-4 text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto">
                    Please read these terms carefully before using our services.
                </p>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 sm:mt-16 content-section">
            <div class="bg-white shadow-xl rounded-xl p-8 sm:p-10 text-gray-700">
                <p>Last updated: {{ date('F j, Y') }}</p>

                <h2>1. Introduction</h2>
                <p>Welcome to <strong>GyaanGhar</strong> ("Company", "we", "our", "us")! These Terms and Conditions ("Terms") govern your use of our website located at <a href="{{ url('/') }}" class="text-indigo-600 hover:underline">{{ url('/') }}</a> (the "Service") operated by GyaanGhar (Comperify).</p>
                <p>Our Privacy Policy also governs your use of our Service and explains how we collect, safeguard, and disclose information that results from your use of our web pages. Please read it here: <a href="/privacy-policy" class="text-indigo-600 hover:underline">Privacy Policy</a>.</p>
                <p>Your agreement with us includes these Terms and our Privacy Policy ("Agreements"). You acknowledge that you have read and understood Agreements, and agree to be bound by them.</p>
                <p>If you do not agree with (or cannot comply with) Agreements, then you may not use the Service, but please let us know by emailing at <a href="mailto:gyaanghar@comperify.com" class="text-indigo-600 hover:underline">gyaanghar@comperify.com</a> so we can try to find a solution. These Terms apply to all visitors, users, and others who wish to access or use Service.</p>

                <h2>2. Use of Our Service</h2>
                <p>By using GyaanGhar, you agree to comply with these Terms and all applicable laws and regulations. You must not use this website in any way that causes, or may cause, damage to the website or impairment of the availability or accessibility of GyaanGhar, or in any way which is unlawful, illegal, fraudulent, or harmful.</p>

                <h3>2.1. Account Registration</h3>
                <p>To access certain features of the Service, you may be required to register for an account. When you register for an account, you agree to provide accurate, current, and complete information during the registration process and to update such information to keep it accurate, current, and complete. We reserve the right to suspend or terminate your account if any information provided during the registration process or thereafter proves to be inaccurate, not current, or incomplete.</p>
                <p>You are responsible for safeguarding the password that you use to access the Service and for any activities or actions under your password. You agree not to disclose your password to any third party.</p>

                <h3>2.2. User Conduct</h3>
                <p>You agree not to use the Service to:</p>
                <ul>
                    <li>Upload, post, email, transmit, or otherwise make available any content that is unlawful, harmful, threatening, abusive, harassing, defamatory, vulgar, obscene, libelous, invasive of another's privacy, hateful, or racially, ethnically, or otherwise objectionable;</li>
                    <li>Harm minors in any way;</li>
                    <li>Impersonate any person or entity, or falsely state or otherwise misrepresent your affiliation with a person or entity;</li>
                    <li>Upload, post, email, transmit, or otherwise make available any content that you do not have a right to make available under any law or under contractual or fiduciary relationships;</li>
                    <li>Upload, post, email, transmit, or otherwise make available any content that infringes any patent, trademark, trade secret, copyright, or other proprietary rights of any party;</li>
                    <li>Engage in any activity that interferes with or disrupts the Service or the servers and networks connected to the Service.</li>
                </ul>

                <h2>3. User-Generated Content</h2>
                <p>Users (primarily "Teachers") may upload content, including text, PDFs, audio files, and quizzes ("User Content") for educational purposes. You are solely responsible for the User Content that you post, upload, link to, or otherwise make available via the Service.</p>
                <p>By making any User Content available through Service, you grant to GyaanGhar a non-exclusive, transferable, sub-licensable, royalty-free, worldwide license to use, copy, modify, create derivative works based upon, distribute, publicly display, publicly perform, and distribute your User Content in connection with operating and providing the Service to you and to other users.</p>
                <p>GyaanGhar does not claim any ownership rights in any User Content. We reserve the right, but are not obligated, to remove or modify User Content for any reason, including User Content that we believe violates these Terms or our policies.</p>
                <p>Any misuse or inappropriate behavior, including the uploading of illegal, harmful, or copyrighted material without permission, may lead to permanent suspension of account access and removal of content.</p>

                <h2>4. Intellectual Property</h2>
                <p>The Service and its original content (excluding User Content), features, and functionality are and will remain the exclusive property of GyaanGhar and its licensors. The Service is protected by copyright, trademark, and other laws of both India and foreign countries. Our trademarks and trade dress may not be used in connection with any product or service without the prior written consent of GyaanGhar.</p>

                <h2>5. Disclaimer of Warranties; Limitation of Liability</h2>
                <p>Please refer to our <a href="/disclaimer" class="text-indigo-600 hover:underline">Disclaimer page</a> for detailed information on the limitations of warranties and liability related to the use of GyaanGhar.</p>
                <p>In summary, the Service is provided on an "AS IS" and "AS AVAILABLE" basis. GyaanGhar makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</p>

                <h2>6. Termination</h2>
                <p>We may terminate or suspend your account and bar access to the Service immediately, without prior notice or liability, under our sole discretion, for any reason whatsoever and without limitation, including but not limited to a breach of Terms.</p>
                <p>If you wish to terminate your account, you may simply discontinue using the Service, or contact us to request account deletion.</p>

                <h2>7. Governing Law</h2>
                <p>These Terms shall be governed and construed in accordance with the laws of India, without regard to its conflict of law provisions. Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights.</p>

                <h2>8. Changes to Terms</h2>
                <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material, we will provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>
                <p>By continuing to access or use our Service after any revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, you are no longer authorized to use the Service.</p>

                <h2>9. Contact Us</h2>
                <p>If you have any questions about these Terms, please contact us:</p>
                <ul>
                    <li>By email: <a href="mailto:gyaanghar@comperify.com" class="text-indigo-600 hover:underline">gyaanghar@comperify.com</a></li>
                    <li>By visiting this page on our website: <a href="/contact-us" class="text-indigo-600 hover:underline">Contact Us</a></li>
                </ul>
                <p>By registering for or using GyaanGhar, you signify your acceptance of these Terms and Conditions. If you do not agree to these terms, please do not use our platform.</p>


                 <div class="mt-10 text-center">
                    <a href="/"
                       class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <ph-house size="20" weight="bold" class="mr-2"></ph-house>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16 w-full">
        <div class="max-w-6xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1">
                 <a href="/" class="flex items-center mb-4">
                    <img src="https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png" alt="GyaanGhar Footer Logo" class="h-10 sm:h-12 mr-2">
                    <span class="text-xl sm:text-2xl font-bold text-white">GyaanGhar</span>
                </a>
                <p class="text-sm text-gray-400">Empowering education through accessible technology. Your digital house of knowledge.</p>
            </div>
            <div class="md:col-span-2">
                <h3 class="text-lg font-semibold mb-3 border-b border-gray-700 pb-2">Quick Links</h3>
                <ul class="space-y-2 text-sm grid grid-cols-2 sm:grid-cols-3 gap-2">
                    <li><a href="/privacy-policy" class="hover:text-blue-400 transition duration-200">Privacy Policy</a></li>
                    <li><a href="/about-us" class="hover:text-blue-400 transition duration-200">About Us</a></li>
                    <li><a href="/contact-us" class="hover:text-blue-400 transition duration-200">Contact Us</a></li>
                    <li><a href="/disclaimer" class="hover:text-blue-400 transition duration-200">Disclaimer</a></li>
                    <li><a href="/terms-and-conditions" class="hover:text-blue-400 transition duration-200">Terms & Conditions</a></li>
                    <li><a href="/review" class="hover:text-blue-400 transition duration-200">Leave a Review</a></li>
                </ul>
            </div>
        </div>
        <div class="text-center py-6 border-t border-gray-700 text-sm text-gray-400">
            © {{ date('Y') }} Comperify (GyaanGhar). All rights reserved.
        </div>
    </footer>

</body>
</html>