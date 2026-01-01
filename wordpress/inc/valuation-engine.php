<?php /**

Staqlt Valuation Engine

Handles business logic, eligibility, and manual review routing. */

class CaravanValuator {

public static function calculate_valuation($lead_data) {
    $base_price = self::get_base_price($lead_data[&#39;make&#39;], $lead_data[&#39;model&#39;], $lead_data[&#39;year&#39;]);
    
    if (!$base_price) {
        return [&#39;status&#39; =&gt; &#39;manual_review&#39;, &#39;reason&#39; =&gt; &#39;Model not in guide&#39;];
    }

    // 1. Eligibility Checks
    if ($lead_data[&#39;country&#39;] !== &#39;England&#39;) {
        return [&#39;status&#39; =&gt; &#39;manual_review&#39;, &#39;reason&#39; =&gt; &#39;Location outside England&#39;];
    }

    // 2. Admin Configurable Rules (from ACF Options Page)
    $desirability_multiplier = get_field(&#39;make_multipliers&#39;, &#39;options&#39;)[$lead_data[&#39;make&#39;]] ?: 1.0;
    $distance_adjustment = self::calculate_distance_penalty($lead_data[&#39;postcode&#39;]);
    
    // 3. Final Calculation
    $final_offer = ($base_price * $desirability_multiplier) - $distance_adjustment;
    
    return [
        &#39;status&#39; =&gt; &#39;instant_valuation&#39;,
        &#39;offer_price&#39; =&gt; round($final_offer, -2),
        &#39;raw_base&#39; =&gt; $base_price
    ];
}

private static function calculate_distance_penalty($postcode) {
    // Implementation of Google Distance Matrix API
    // Returns £ deduction based on miles from HQ
    return 150; // Mock value
}


}