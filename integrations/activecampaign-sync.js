/**

ActiveCampaign Integration

Triggers WhatsApp and Email based on valuation outcome. */

async function syncToCRM(lead, valuation) { const payload = { contact: { email: lead.email, firstName: lead.firstName, phone: lead.phone }, fields: { "Valuation_Status": valuation.status, "Instant_Offer_Price": valuation.offer_price || 0, "Review_Reason": valuation.reason || "" } };

// Push to ActiveCampaign and trigger Automation
const response = await fetch(&#39;[https://staqlt.api-us1.com/api/3/contact/sync](https://staqlt.api-us1.com/api/3/contact/sync)&#39;, {
    method: &#39;POST&#39;,
    headers: { &#39;Api-Token&#39;: process.env.AC_API_KEY },
    body: JSON.stringify(payload)
});

return response.json();


}