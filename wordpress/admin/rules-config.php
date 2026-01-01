<?php /**

Admin Interface for Pricing Rules

Uses ACF Pro to give clients direct control over logic. */

if( function_exists('acf_add_options_page') ) { acf_add_options_page(array( 'page_title' => 'Valuation Rules', 'menu_title' => 'Valuation Rules', 'menu_slug' => 'valuation-rules', 'capability' => 'manage_options', 'redirect' => false )); }

// Fields to include: // - Radius limit (miles) // - Excluded Postcodes // - Make/Model Multipliers // - Year-based % adjustments