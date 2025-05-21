<?php

namespace App\Http\Controllers\User;

use App\Conversations\OnboardingConversation;
use App\Http\Controllers\Controller;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatBotController extends Controller
{
    /**
     * Hiển thị trang chatbot
     */
    public function index()
    {
        return view('user.chatbot_box');
    }

    /**
     * Xử lý yêu cầu từ BotMan
     */
    public function handle(Request $request)
    {
        // Lấy tin nhắn từ request
        $message = $request->get('message', '');

        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

        $config = [
            'web' => [
                'matchingData' => [
                    'driver' => 'web',
                ],
            ]
        ];

        $botman = BotManFactory::create($config);

        // Định nghĩa phản hồi mặc định
        $botman->fallback(function (BotMan $bot) {
            $bot->reply('Xin lỗi, tôi không hiểu câu hỏi của bạn. Hãy thử hỏi về lập trình PHP, Laravel hoặc các vấn đề kỹ thuật khác.');
        });

        // Định nghĩa các mẫu hội thoại
        $botman->hears('xin chào|chào|hello|hi', function (BotMan $bot) {
            $bot->reply('Xin chào! Tôi là trợ lý lập trình. Tôi có thể giúp gì cho bạn?');
        });

        $botman->hears('laravel là gì', function (BotMan $bot) {
            $bot->reply('Laravel là một PHP framework mã nguồn mở, miễn phí, dựa trên mô hình MVC cho phát triển ứng dụng web hiện đại.');
        });

        $botman->hears('php (.*)', function (BotMan $bot, $version) {
            $bot->reply("Bạn đang hỏi về PHP $version. Đây là một ngôn ngữ lập trình phổ biến cho phát triển web.");
        });

        // Thêm các câu trả lời khác
        $botman->hears('botman', function (BotMan $bot) {
            $bot->reply('BotMan là một framework để xây dựng chatbot đa nền tảng với PHP.');
        });

        // Nếu không nhận được tin nhắn từ request, trả về phản hồi thủ công
        if (empty($message)) {
            return response()->json(['status' => 'error', 'message' => 'Không nhận được tin nhắn']);
        }

        // Xử lý tin nhắn thủ công nếu cần
        $botman->hears('.*', function (BotMan $bot) use ($message) {
            // Dùng để debug
            // $bot->reply('Đã nhận tin nhắn: ' . $message);
        });

        // Bắt đầu lắng nghe
        $botman->listen();

        // Nếu không có phản hồi, thử trả về phản hồi thủ công
        // Đây là giải pháp tạm thời để debug
        return response()->json([
            'messages' => [
                ['text' => 'Đã nhận tin nhắn: ' . $message . '. Đang xử lý...']
            ]
        ]);
    }

    /**
     * Xử lý tin nhắn thủ công
     */
    public function handleManual(Request $request)
    {
        $message = $request->get('message', '');

        // Xử lý tin nhắn đơn giản để test
        $reply = 'Không hiểu yêu cầu';

        if (
            strpos(strtolower($message), 'xin chào') !== false ||
            strpos(strtolower($message), 'chào') !== false ||
            strpos(strtolower($message), 'hello') !== false ||
            strpos(strtolower($message), 'hi') !== false
        ) {
            $reply = 'Xin chào! Tôi là trợ lý lập trình. Tôi có thể giúp gì cho bạn?';
        } else if (strpos(strtolower($message), 'laravel') !== false) {
            $reply = 'Laravel là một PHP framework mã nguồn mở, miễn phí, dựa trên mô hình MVC cho phát triển ứng dụng web hiện đại.';
        } else if (strpos(strtolower($message), 'php') !== false) {
            $reply = 'PHP là một ngôn ngữ lập trình phổ biến cho phát triển web.';
        } else if (strpos(strtolower($message), 'botman') !== false) {
            $reply = 'BotMan là một framework để xây dựng chatbot đa nền tảng với PHP.';
        }

        return response()->json([
            'messages' => [
                ['text' => $reply]
            ]
        ]);
    }
}
