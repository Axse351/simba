<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    /**
     * Handle chatbot message
     */
    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        try {
            $userMessage = $request->message;

            // Gunakan API Anthropic Claude (atau API lain yang Anda gunakan)
            $response = $this->getChatbotResponse($userMessage);

            return response()->json([
                'success' => true,
                'response' => $response
            ]);

        } catch (\Exception $e) {
            Log::error('Chatbot Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses pesan'
            ], 500);
        }
    }

    /**
     * Get chatbot response from AI API
     */
    private function getChatbotResponse($message)
    {
        // OPSI 1: Menggunakan API Anthropic Claude
        $apiKey = env('ANTHROPIC_API_KEY');

        if (!$apiKey) {
            return $this->getDefaultResponse($message);
        }

        try {
            $response = Http::withHeaders([
                'x-api-key' => $apiKey,
                'anthropic-version' => '2023-06-01',
                'content-type' => 'application/json',
            ])->post('https://api.anthropic.com/v1/messages', [
                'model' => 'claude-3-5-sonnet-20241022',
                'max_tokens' => 1024,
                'system' => 'Anda adalah asisten kesehatan virtual yang ramah dan membantu. Berikan informasi kesehatan yang akurat dan mudah dipahami. Selalu ingatkan pengguna untuk berkonsultasi dengan dokter untuk diagnosis dan pengobatan yang tepat.',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $message
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['content'][0]['text'] ?? 'Maaf, saya tidak dapat memproses pertanyaan Anda saat ini.';
            }

            return $this->getDefaultResponse($message);

        } catch (\Exception $e) {
            Log::error('API Error: ' . $e->getMessage());
            return $this->getDefaultResponse($message);
        }
    }

    /**
     * Get default response when API is unavailable
     */
    private function getDefaultResponse($message)
    {
        $message = strtolower($message);

        // Respon default berdasarkan kata kunci
        if (str_contains($message, 'halo') || str_contains($message, 'hai') || str_contains($message, 'hello')) {
            return 'Halo! Ada yang bisa saya bantu terkait kesehatan Anda?';
        }

        if (str_contains($message, 'terima kasih') || str_contains($message, 'thanks')) {
            return 'Sama-sama! Semoga informasinya bermanfaat. Jangan ragu untuk bertanya lagi jika ada yang ingin ditanyakan.';
        }

        if (str_contains($message, 'demam') || str_contains($message, 'panas')) {
            return 'Demam biasanya merupakan tanda bahwa tubuh sedang melawan infeksi. Beberapa hal yang dapat dilakukan: istirahat yang cukup, minum air putih yang banyak, dan kompres hangat. Jika demam tinggi (>38.5°C) atau berlangsung lebih dari 3 hari, segera konsultasi ke dokter.';
        }

        if (str_contains($message, 'batuk') || str_contains($message, 'pilek')) {
            return 'Batuk dan pilek umumnya disebabkan oleh infeksi virus. Cara mengatasinya: istirahat cukup, minum air hangat, konsumsi makanan bergizi, dan hindari perubahan suhu ekstrem. Jika gejala memburuk atau tidak membaik dalam 7 hari, sebaiknya periksa ke dokter.';
        }

        if (str_contains($message, 'sakit kepala') || str_contains($message, 'pusing')) {
            return 'Sakit kepala bisa disebabkan oleh berbagai hal seperti stres, kurang tidur, dehidrasi, atau tegang otot. Cobalah istirahat, minum air yang cukup, dan hindari layar gadget. Jika sakit kepala parah atau terus menerus, konsultasi ke dokter.';
        }

        if (str_contains($message, 'vitamin') || str_contains($message, 'suplemen')) {
            return 'Vitamin dan suplemen sebaiknya dikonsumsi sesuai kebutuhan tubuh. Lebih baik mendapatkan nutrisi dari makanan sehat dan seimbang. Jika ingin mengonsumsi suplemen, konsultasikan dengan dokter atau ahli gizi terlebih dahulu.';
        }

        if (str_contains($message, 'imunisasi') || str_contains($message, 'vaksin')) {
            return 'Imunisasi sangat penting untuk melindungi dari berbagai penyakit. Pastikan jadwal imunisasi anak Anda lengkap sesuai rekomendasi IDAI (Ikatan Dokter Anak Indonesia). Untuk informasi lebih detail, konsultasi dengan dokter atau bidan.';
        }

        if (str_contains($message, 'hamil') || str_contains($message, 'kehamilan')) {
            return 'Selama kehamilan, penting untuk rutin memeriksakan kesehatan ke bidan atau dokter kandungan, konsumsi makanan bergizi, istirahat cukup, dan hindari stres. Jangan lupa konsumsi asam folat dan vitamin prenatal sesuai anjuran dokter.';
        }

        if (str_contains($message, 'bayi') || str_contains($message, 'balita')) {
            return 'Kesehatan bayi dan balita memerlukan perhatian khusus. Pastikan ASI eksklusif hingga 6 bulan, imunisasi lengkap, dan pemantauan tumbuh kembang rutin. Jika ada keluhan kesehatan pada bayi/balita, segera konsultasi ke dokter anak.';
        }

        // Default response
        return 'Terima kasih atas pertanyaan Anda. Untuk informasi kesehatan yang lebih spesifik dan akurat, saya sarankan untuk berkonsultasi langsung dengan tenaga kesehatan profesional. Apakah ada pertanyaan lain yang bisa saya bantu?';
    }
}
