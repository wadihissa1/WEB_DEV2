<?php
namespace App\Http\Controllers;
   
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
   
class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');
   
        $botman->hears('{message}', function($botman, $message) {
   
            if (strtolower($message) == 'hi' || strtolower($message) == 'hello') {
                $this->askName($botman);
            }
            
            else{
                $botman->reply("Start a conversation by saying hi.");
            }
   
        });
   
        $botman->listen();
    }
   
    /**
     * Initiates the conversation by asking for the user's name.
     */
    public function askName($botman)
    {
        $botman->ask('Hello! What is your name?', function(Answer $answer, $conversation) {

            $name = $answer->getText();

            $this->say('Nice to meet you, '.$name.'.');

            $conversation->ask('Please describe the issue or question you have,Type "orders" for order problems, "payments"  for payment problems, and "products"  for product problems .', function (Answer $answer, $conversation){
                
                $issueDescription = $answer->getText();
                
                    switch ($issueDescription) {
                        case 'orders':
                            $conversation->ask('What seems to be the problem with your order? Is it delayed shipping "Type delay/late/wrong/false", wrong items "Type failed/refund", or something else "Type damaged/description"?', function (Answer $answer, $conversation){
                                $issue = strtolower($answer->getText());
                        
                                switch ($issue) {
                                    case 'delay':
                                    case 'late':
                                        $conversation->say('I apologize for the delay. Let me check the status of your order.');
                                        // Provide information about the order status
                                        break;
                                    case 'wrong':
                                    case 'false':
                                        $conversation->say('I am sorry for the inconvenience. Please provide your order number so I can assist you further.');
                                        // Ask for the order number to track the order
                                        break;
                                    default:
                                        $conversation->say('I understand. Please provide more details about your order issue so I can assist you better.');
                                        // Further inquire about the issue
                                        break;
                                }
                            });
                            break;


                        case 'payments':
                            $conversation->ask('What payment issue are you experiencing? Is it about failed transactions, refunds, or something else?', function (Answer $answer, $conversation){
                                $issue = strtolower($answer->getText());
                        
                                switch ($issue) {
                                    case 'failed':
                                        $conversation->say('I apologize for the inconvenience. Let me assist you in resolving the failed transaction.');
                                        // Provide guidance on resolving payment failure
                                        break;
                                    case 'refund':
                                        $conversation->say('I understand. Please provide your order number and details about the refund request.');
                                        // Ask for order details for refund processing
                                        break;
                                    default:
                                        $conversation->say('Could you please provide more details about the payment issue you are facing?');
                                        // Further inquire about the payment issue
                                        break;
                                }
                            });
                            break;


                        case 'products':
                            $conversation->ask('What seems to be the problem with the product? Is it damaged, not as described, or something else?', function (Answer $answer, $conversation){
                                $issue = strtolower($answer->getText());
                        
                                switch ($issue) {
                                    case 'damage':
                                        $conversation->say('I\'m sorry for the inconvenience. Please provide details about the damage, and we will assist you accordingly.');
                                        // Inquire about the damage details for further assistance
                                        break;
                                    case 'description':
                                        $conversation->say('I apologize for the discrepancy. Could you please provide more information about the product description issue?');
                                        // Further inquire about the product description issue
                                        break;
                                    default:
                                        $conversation->say('I understand. Please provide more details about the product issue you are facing.');
                                        // Further inquire about the product issue
                                        break;
                                }
                            });
                            break;


                        default:
                            $conversation->say('I am sorry, I could not understand your selection. Please choose one of the provided options.');
                            $conversation->repeat(); // Repeat the question
                            break;
                    }


            });
        });
    }

    /**
     * Ends the conversation.
     */
    public function endConversation($conversation)
    {
        $conversation->say('Is there anything else I can assist you with? If not, feel free to say "bye" to end the conversation.');
    }
}
