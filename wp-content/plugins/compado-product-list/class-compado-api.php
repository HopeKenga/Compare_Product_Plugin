<?php
class Compado_API {
    private $base_url;

    public function __construct($base_url) {
        $this->base_url = trailingslashit($base_url);
    }

    public function get_products() {
        // Append the specific endpoint to the base URL
        $url = $this->base_url . 'host/205/category/home/default';

        $response = wp_remote_get($url, ['timeout' => 20]);

        if (is_wp_error($response)) {
            error_log('Compado API Error: ' . $response->get_error_message());
            return [];
        }

        if (wp_remote_retrieve_response_code($response) != 200) {
            error_log('Compado API Error: Unexpected response code ' . wp_remote_retrieve_response_code($response));
            return [];
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        $products = [];
        if (isset($data['partners']) && is_array($data['partners'])) {
            foreach ($data['partners'] as $partner) {
                $marketingProperties = $this->processMarketingProperties($partner['marketing_properties'] ?? []);

                $product = [
                    'clicked_partner_name'=> $partner['clicked_partner_name'] ?? '',
                    'partner_id' => $partner['partner_id'] ?? '',
                    'partner_name' => $partner['partner_name'] ?? '',
                    'partner_slug' => $partner['partner_slug'] ?? '',
                    'cp_id' => $partner['cp_id'] ?? '',
                    'logo_image' => isset($partner['logo_image']) ? $partner['logo_image'] : '',
                    'cover_image' => isset($partner['cover_image']) ? $partner['cover_image'] : '',
                    'score' => isset($partner['score']) ? $partner['score'] : '',
                    'rating' => isset($partner['rating']) ? $partner['rating'] : '',
                    'rating_mobile' => isset($partner['rating_mobile']) ? $partner['rating_mobile'] : '',
                    'score_order' => isset($partner['score_order']) ? $partner['score_order'] : '',
                    'mobile_score_order' => isset($partner['mobile_score_order']) ? $partner['mobile_score_order'] : '',
                    'redirect_provider_id' => isset($partner['redirect_provider_id']) ? $partner['redirect_provider_id'] : '',
                    'redirect_provider_mobile_id' => isset($partner['redirect_provider_mobile_id']) ? $partner['redirect_provider_mobile_id'] : '',
                    'partner_clickout_name' => isset($partner['partner_clickout_name']) ? $partner['partner_clickout_name'] : '',
                    'default_provider_logo' => isset($partner['default_provider_logo']) ? $partner['default_provider_logo'] : '',
                    'default_provider_cover_image' => isset($partner['default_provider_cover_image']) ? $partner['default_provider_cover_image'] : '',
                    'partner_provider_id' => isset($partner['partner_provider_id']) ? $partner['partner_provider_id'] : '',
                    'cta_button_text' => isset($partner['cta_button_text']) ? $partner['cta_button_text'] : '',
                    'article_cta_text' => isset($partner['article_cta_text']) ? $partner['article_cta_text'] : '',
                    'enable_frr' => isset($partner['enable_frr']) ? $partner['enable_frr'] : '',
                    'enable_frr_mobile' => isset($partner['enable_frr_mobile']) ? $partner['enable_frr_mobile'] : '',
                    'limited_offer' => isset($partner['limited_offer']) ? $partner['limited_offer'] : '',
                    'video_link' => isset($partner['video_link']) ? $partner['video_link'] : '',
                    'frr_percentage' => isset($partner['frr_percentage']) ? $partner['frr_percentage'] : '',
                    'frr_percentage_mobile' => isset($partner['frr_percentage_mobile']) ? $partner['frr_percentage_mobile'] : '',
                    'pctsp_id' => isset($partner['pctsp_id']) ? $partner['pctsp_id'] : '',
                    'review_slug' => isset($partner['review_slug']) ? $partner['review_slug'] : '',
                    'api_clickout' => isset($partner['api_clickout']) ? $partner['api_clickout'] : '',
                    'api_banner_url' => isset($partner['api_banner_url']) ? $partner['api_banner_url'] : '',
                    'api_bottombanner_url' => isset($partner['api_bottombanner_url']) ? $partner['api_bottombanner_url'] : '',
                    'api_exitover_url' => isset($partner['api_exitover_url']) ? $partner['api_exitover_url'] : '',
                    'api_clickout_cta' => isset($partner['api_clickout_cta']) ? $partner['api_clickout_cta'] : '',
                    'provider_id' => isset($partner['provider_id']) ? $partner['provider_id'] : '',
                    'api_clickout_ig' => isset($partner['api_clickout_ig']) ? $partner['api_clickout_ig'] : '',
                    'ranking_source' => isset($partner['ranking_source']) ? $partner['ranking_source'] : '',
                    'filters' => isset($partner['filters']) ? $partner['filters'] : '',
                    'introduction' => isset($partner['introduction']) ? $partner['introduction'] : '',
                    'members' => isset($partner['members']) ? $partner['members'] : '',
                    'flag' => isset($partner['flag']) ? $partner['flag'] : '',
                    'seo_review_url' => isset($partner['seo_review_url']) ? $partner['seo_review_url'] : '',
                    'pricing' => isset($partner['pricing']) ? $partner['pricing'] : '',
                    'countries' => isset($partner['countries']) ? $partner['countries'] : '',
                    'guarantee' => isset($partner['guarantee']) ? $partner['guarantee'] : '',
                    'has_review' => isset($partner['has_review']) ? $partner['has_review'] : '',
                    'icons' => isset($partner['icons']) ? $partner['icons'] : '',
                    'marketing_properties' => $marketingProperties,
                ];
                $products[] = $product;
            }
        }

        return $products;
    }

    private function processMarketingProperties($marketingProperties): array
    {
        // Initialize an array to hold the processed marketing properties
        $processedProperties = [];

        // Iterate through each property and process as needed
        foreach ($marketingProperties as $key => $value) {
            // For example, you can manipulate or format the value here if needed
            $processedProperties[$key] = $value;
        }

        return $processedProperties;
    }
}
