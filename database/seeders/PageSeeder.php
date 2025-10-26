<?php
/**
 * Copyright (c) Since 2024 MySara - All Rights Reserved
 *
 * @link       https://www.mysara.com
 * @author     MySara <team@mysara.com>
 * @license    https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use MySara\Common\Models\Page;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $items = $this->getPages();
        if ($items) {
            Page::query()->truncate();
            foreach ($items as $item) {
                Page::query()->create($item);
            }
        }

        $items = $this->getPageTranslations();
        if ($items) {
            $items = array_values(array_filter($items, function ($item) {
                return ($item['locale'] ?? '') === 'en';
            }));
            Page\Translation::query()->truncate();
            foreach ($items as $item) {
                Page\Translation::query()->create($item);
            }
        }
    }

    /**
     * @return array[]
     */
    private function getPages(): array
    {
        return [
            [
                'id'     => 1,
                'slug'   => 'creations',
                'viewed' => 666,
                'active' => 1,
            ],
            [
                'id'     => 2,
                'slug'   => 'services',
                'viewed' => 888,
                'active' => 1,
            ],
            [
                'id'     => 3,
                'slug'   => 'about',
                'viewed' => 999,
                'active' => 1,
            ],
            [
                'id'     => 4,
                'slug'   => 'privacy-policy',
                'viewed' => 0,
                'active' => 1,
            ],
        ];
    }

    /**
     * @return array[]
     */
    private function getPageTranslations(): array
    {
        return [
            [
                'page_id'          => 1,
                'locale'           => 'en',
                'title'            => 'Creations',
                'content'          => 'This is Creations page for English',
                'meta_title'       => 'Creations',
                'meta_description' => 'Creations',
                'meta_keywords'    => 'Creations',
            ],
            [
                'page_id'          => 2,
                'locale'           => 'en',
                'title'            => 'Services',
                'content'          => 'This is Services page for English',
                'meta_title'       => 'Services',
                'meta_description' => 'Services',
                'meta_keywords'    => 'Services',
            ],
            [
                'page_id'          => 3,
                'locale'           => 'en',
                'title'            => 'About',
                'content'          => 'This is About page for English',
                'meta_title'       => 'About Us',
                'meta_description' => 'About Us',
                'meta_keywords'    => 'About Us',
            ],
            [
                'page_id' => 4,
                'locale'  => 'en',
                'title'   => 'Privacy Policy',
                'content' => '<p>MySara takes your privacy seriously. This Privacy Policy explains how we collect, use, and protect your personal information.</p>

<h3>1. Information Collection</h3>
<p>We collect the following information:</p>
<ul>
    <li>Account information: email, username, etc.</li>
    <li>Device information: IP address, browser type, etc.</li>
    <li>Usage data: access records, operation logs, etc.</li>
</ul>

<h3>2. Information Usage</h3>
<p>We use the collected information to:</p>
<ul>
    <li>Provide and improve services</li>
    <li>Send important notifications</li>
    <li>Prevent fraud and abuse</li>
</ul>

<h3>3. Information Protection</h3>
<p>We implement strict security measures to protect your information, including:</p>
<ul>
    <li>Data encryption</li>
    <li>Access control</li>
    <li>Regular security audits</li>
</ul>

<h3>4. Information Sharing</h3>
<p>We do not sell your personal information. We may share information only in the following cases:</p>
<ul>
    <li>With your explicit consent</li>
    <li>When required by law</li>
    <li>To protect our legal rights</li>
</ul>

<h3>5. Your Rights</h3>
<p>You have the right to:</p>
<ul>
    <li>Access your personal information</li>
    <li>Correct inaccurate information</li>
    <li>Request deletion of your information</li>
    <li>Restrict information processing</li>
</ul>

<h3>6. Contact Us</h3>
<p>If you have any questions about our Privacy Policy, please contact us:</p>
<p>Email: privacy@mysara.com</p>',
                'meta_title'       => 'Privacy Policy - MySara',
                'meta_description' => 'MySara Privacy Policy',
                'meta_keywords'    => 'Privacy Policy, Data Protection, Personal Information',
            ],
        ];
    }
}
