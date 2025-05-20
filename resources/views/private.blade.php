<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - GyaanGhar</title>
    <meta name="robots" content="index, follow">
    <meta name="description" content="Learn how GyaanGhar collects, uses, and protects your personal information. Your privacy is important to us.">

    <link rel="canonical" href="{{ url('/privacy-policy') }}" />
    <meta property="og:title" content="Privacy Policy - GyaanGhar" />
    <meta property="og:description" content="Learn how GyaanGhar collects, uses, and protects your personal information. Your privacy is important to us." />
    <meta property="og:url" content="{{ url('/privacy-policy') }}" />
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
            display: flex; /* Added for sticky footer */
            flex-direction: column; /* Added for sticky footer */
            min-height: 100vh; /* Added for sticky footer */
        }
        main { /* Added for sticky footer */
            flex-grow: 1;
        }
        .content-section p, .content-section li {
            line-height: 1.75;
            margin-bottom: 1rem;
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
        .content-section a {
            color: #4f46e5; /* indigo-600 */
            text-decoration: underline;
        }
        .content-section a:hover {
            color: #4338ca; /* indigo-700 */
        }
         /* Ensure Phosphor icons inherit text color if not set explicitly */
        [class^="ph-"] {
            vertical-align: middle; /* Better alignment with text */
        }
    </style>

    @php
        // --- Schema.org Data Preparation ---
        $siteBaseUrl = rtrim(url('/'), '/');
        $pageFullUrl = url('/privacy-policy'); // Specific URL

        $organizationSchema = [
            '@type' => 'Organization',
            '@id' => $siteBaseUrl . '#organization',
            'name' => 'GyaanGhar',
            'url' => $siteBaseUrl,
            'logo' => 'https://i.ibb.co/zVrW7Pdx/Chat-GPT-Image-May-13-2025-05-04-54-PM-removebg-preview.png',
            'description' => 'GyaanGhar is the ultimate platform for personalized learning and seamless access to educational resources.',
             'contactPoint' => [
                [
                    '@type' => 'ContactPoint',
                    'email' => 'gyaanghar@comperify.com', // Make sure this is your privacy contact
                    'contactType' => 'Privacy Inquiries',
                ]
            ]
        ];

        $privacyPageSchema = [
            '@type' => 'WebPage', // Could also use 'PrivacyPolicyPage' if that becomes standard
            '@id' => $pageFullUrl . '#webpage',
            'url' => $pageFullUrl,
            'name' => 'Privacy Policy - GyaanGhar',
            'description' => "Learn how GyaanGhar collects, uses, and protects your personal information. Your privacy is important to us.",
            'isPartOf' => ['@id' => $siteBaseUrl . '#organization'],
            'publisher' => ['@id' => $siteBaseUrl . '#organization'],
            'mainEntity' => [
                '@type' => 'WebContent', // Or CreativeWork
                'headline' => 'GyaanGhar Privacy Policy',
                // 'text' => "Full text of Privacy Policy could go here for schema."
            ],
            'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $siteBaseUrl],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Privacy Policy']
                ]
            ],
            'datePublished' => '2024-05-13', // Date your policy was first published or this version
            'dateModified' => date('Y-m-d') // Date this specific version was last modified
        ];

        $finalSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                $organizationSchema,
                $privacyPageSchema
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
        <!-- Hero Section for Privacy Policy -->
        <div class="bg-gradient-to-br from-blue-50 via-green-50 to-teal-50 py-16 sm:py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <ph-shield-check size="64" weight="duotone" class="text-blue-600 mx-auto mb-4"></ph-shield-check>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 tracking-tight">
                    Privacy Policy
                </h1>
                <p class="mt-4 text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto">
                    Your privacy is critically important to us. This policy outlines how we handle your personal information.
                </p>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 sm:mt-16 content-section">
            <div class="bg-white shadow-xl rounded-xl p-8 sm:p-10 text-gray-700">
                <p>Last updated: {{ date('F j, Y') }}</p>
                <p>GyaanGhar ("us", "we", or "our") operates the <a href="{{ url('/') }}">{{ url('/') }}</a> website (hereinafter referred to as the "Service"). This page informs you of our policies regarding the collection, use, and disclosure of personal data when you use our Service and the choices you have associated with that data.</p>
                <p>We use your data to provide and improve the Service. By using the Service, you agree to the collection and use of information in accordance with this policy. Unless otherwise defined in this Privacy Policy, the terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, accessible from <a href="/terms-and-conditions">/terms-and-conditions</a>.</p>

                <h2>1. Information Collection and Use</h2>
                <p>We collect several different types of information for various purposes to provide and improve our Service to you.</p>
                <h3>Types of Data Collected</h3>
                <h4>Personal Data</h4>
                <p>While using our Service, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you ("Personal Data"). Personally identifiable information may include, but is not limited to:</p>
                <ul>
                    <li>Email address</li>
                    <li>First name and last name</li>
                    <li>Role (e.g., Teacher, Student)</li>
                    <li>Cookies and Usage Data</li>
                    <li>IP address (collected automatically as Usage Data)</li>
                </ul>
                <p>We may use your Personal Data to contact you with newsletters, marketing or promotional materials, and other information that may be of interest to you, only if you have opted-in to receive such communications. You may opt out of receiving any, or all, of these communications from us by following the unsubscribe link or instructions provided in any email we send.</p>

                <h4>Usage Data</h4>
                <p>We may also collect information on how the Service is accessed and used ("Usage Data"). This Usage Data may include information such as your computer's Internet Protocol address (e.g., IP address), browser type, browser version, the pages of our Service that you visit, the time and date of your visit, the time spent on those pages, unique device identifiers, and other diagnostic data.</p>

                <h4>Tracking & Cookies Data</h4>
                <p>We use cookies and similar tracking technologies to track the activity on our Service and we hold certain information. Cookies are files with a small amount of data which may include an anonymous unique identifier. Cookies are sent to your browser from a website and stored on your device. Other tracking technologies are also used such as beacons, tags, and scripts to collect and track information and to improve and analyze our Service.</p>
                <p>You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Service.</p>
                <p>Examples of Cookies we use:</p>
                <ul>
                    <li><strong>Session Cookies:</strong> We use Session Cookies to operate our Service.</li>
                    <li><strong>Preference Cookies:</strong> We use Preference Cookies to remember your preferences and various settings.</li>
                    <li><strong>Security Cookies:</strong> We use Security Cookies for security purposes.</li>
                </ul>

                <h2>2. Use of Data</h2>
                <p>GyaanGhar uses the collected data for various purposes:</p>
                <ul>
                    <li>To provide and maintain our Service</li>
                    <li>To notify you about changes to our Service</li>
                    <li>To allow you to participate in interactive features of our Service when you choose to do so</li>
                    <li>To provide customer support</li>
                    <li>To gather analysis or valuable information so that we can improve our Service</li>
                    <li>To monitor the usage of our Service</li>
                    <li>To detect, prevent and address technical issues</li>
                    <li>To provide you with news, special offers, and general information about other goods, services, and events which we offer that are similar to those that you have already purchased or enquired about unless you have opted not to receive such information (if applicable)</li>
                </ul>

                <h2>3. Legal Basis for Processing Personal Data under General Data Protection Regulation (GDPR)</h2>
                <p>If you are from the European Economic Area (EEA), GyaanGhar's legal basis for collecting and using the personal information described in this Privacy Policy depends on the Personal Data we collect and the specific context in which we collect it.</p>
                <p>GyaanGhar may process your Personal Data because:</p>
                <ul>
                    <li>We need to perform a contract with you (e.g., to provide our Service)</li>
                    <li>You have given us permission to do so</li>
                    <li>The processing is in our legitimate interests and it is not overridden by your rights</li>
                    <li>To comply with the law</li>
                </ul>

                <h2>4. Data Retention</h2>
                <p>GyaanGhar will retain your Personal Data only for as long as is necessary for the purposes set out in this Privacy Policy. We will retain and use your Personal Data to the extent necessary to comply with our legal obligations (for example, if we are required to retain your data to comply with applicable laws), resolve disputes, and enforce our legal agreements and policies.</p>
                <p>GyaanGhar will also retain Usage Data for internal analysis purposes. Usage Data is generally retained for a shorter period, except when this data is used to strengthen the security or to improve the functionality of our Service, or we are legally obligated to retain this data for longer periods.</p>

                <h2>5. Data Transfer</h2>
                <p>Your information, including Personal Data, may be transferred to — and maintained on — computers located outside of your state, province, country, or other governmental jurisdiction where the data protection laws may differ from those of your jurisdiction.</p>
                <p>If you are located outside India and choose to provide information to us, please note that we transfer the data, including Personal Data, to India and process it there.</p>
                <p>Your consent to this Privacy Policy followed by your submission of such information represents your agreement to that transfer.</p>
                <p>GyaanGhar will take all the steps reasonably necessary to ensure that your data is treated securely and in accordance with this Privacy Policy and no transfer of your Personal Data will take place to an organization or a country unless there are adequate controls in place including the security of your data and other personal information.</p>

                <h2>6. Disclosure of Data</h2>
                <h3>Legal Requirements</h3>
                <p>GyaanGhar may disclose your Personal Data in the good faith belief that such action is necessary to:</p>
                <ul>
                    <li>To comply with a legal obligation</li>
                    <li>To protect and defend the rights or property of GyaanGhar</li>
                    <li>To prevent or investigate possible wrongdoing in connection with the Service</li>
                    <li>To protect the personal safety of users of the Service or the public</li>
                    <li>To protect against legal liability</li>
                </ul>

                <h2>7. Security of Data</h2>
                <p>The security of your data is important to us but remember that no method of transmission over the Internet or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Data, we cannot guarantee its absolute security.</p>

                <h2>8. Your Data Protection Rights</h2>
                <p>GyaanGhar aims to take reasonable steps to allow you to correct, amend, delete, or limit the use of your Personal Data. If you wish to be informed about what Personal Data we hold about you and if you want it to be removed from our systems, please contact us.</p>
                <p>In certain circumstances, you have the following data protection rights:</p>
                <ul>
                    <li><strong>The right to access, update or delete</strong> the information we have on you.</li>
                    <li><strong>The right of rectification.</strong> You have the right to have your information rectified if that information is inaccurate or incomplete.</li>
                    <li><strong>The right to object.</strong> You have the right to object to our processing of your Personal Data.</li>
                    <li><strong>The right of restriction.</strong> You have the right to request that we restrict the processing of your personal information.</li>
                    <li><strong>The right to data portability.</strong> You have the right to be provided with a copy of the information we have on you in a structured, machine-readable and commonly used format.</li>
                    <li><strong>The right to withdraw consent.</strong> You also have the right to withdraw your consent at any time where GyaanGhar relied on your consent to process your personal information.</li>
                </ul>
                <p>Please note that we may ask you to verify your identity before responding to such requests.</p>
                <p>You have the right to complain to a Data Protection Authority about our collection and use of your Personal Data. For more information, please contact your local data protection authority in the European Economic Area (EEA).</p>


                <h2>9. Service Providers (Third-Party Services)</h2>
                <p>We may employ third-party companies and individuals to facilitate our Service ("Service Providers"), provide the Service on our behalf, perform Service-related services, or assist us in analyzing how our Service is used. These third parties have access to your Personal Data only to perform these tasks on our behalf and are obligated not to disclose or use it for any other purpose.</p>
                <h3>Analytics</h3>
                <p>We may use third-party Service Providers to monitor and analyze the use of our Service.</p>
                <ul>
                    <li><strong>Google Analytics:</strong> Google Analytics is a web analytics service offered by Google that tracks and reports website traffic. Google uses the data collected to track and monitor the use of our Service. This data is shared with other Google services. Google may use the collected data to contextualize and personalize the ads of its own advertising network. You can opt-out of having made your activity on the Service available to Google Analytics by installing the Google Analytics opt-out browser add-on. For more information on the privacy practices of Google, please visit the Google Privacy & Terms web page: <a href="https://policies.google.com/privacy?hl=en">https://policies.google.com/privacy?hl=en</a></li>
                </ul>
                {{-- Add other services like AdSense if used --}}
                {{--
                <h3>Advertising</h3>
                <p>We may use third-party Service Providers to show advertisements to you to help support and maintain our Service.</p>
                <ul>
                    <li><strong>Google AdSense & DoubleClick Cookie:</strong> Google, as a third-party vendor, uses cookies to serve ads on our Service. Google's use of the DoubleClick cookie enables it and its partners to serve ads to our users based on their visit to our Service or other websites on the Internet. You may opt out of the use of the DoubleClick Cookie for interest-based advertising by visiting the Google Ads Settings web page: <a href="http://www.google.com/ads/preferences/">http://www.google.com/ads/preferences/</a></li>
                </ul>
                --}}

                <h2>10. Links to Other Sites</h2>
                <p>Our Service may contain links to other sites that are not operated by us. If you click a third-party link, you will be directed to that third party's site. We strongly advise you to review the Privacy Policy of every site you visit.</p>
                <p>We have no control over and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.</p>

                <h2>11. Children's Privacy</h2>
                <p>Our Service does not address anyone under the age of 13 ("Children"). We do not knowingly collect personally identifiable information from anyone under the age of 13. If you are a parent or guardian and you are aware that your Child has provided us with Personal Data, please contact us. If we become aware that we have collected Personal Data from children without verification of parental consent, we take steps to remove that information from our servers.</p>
                <p>Depending on your jurisdiction, the age of consent for data processing may be higher (e.g., 16 in some parts of the EU). We comply with such requirements.</p>

                <h2>12. Changes to This Privacy Policy</h2>
                <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page. We will let you know via email and/or a prominent notice on our Service, prior to the change becoming effective and update the "Last updated" date at the top of this Privacy Policy.</p>
                <p>You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>

                <h2>13. Contact Us</h2>
                <p>If you have any questions about this Privacy Policy, please contact us:</p>
                <ul>
                    <li>By email: <a href="mailto:gyaanghar@comperify.com">gyaanghar@comperify.com</a></li>
                    <li>By visiting this page on our website: <a href="/contact-us">Contact Us</a></li>
                </ul>

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
    <footer class="bg-gray-800 text-white w-full">
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