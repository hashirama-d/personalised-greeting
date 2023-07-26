<?php

namespace Drupal\personalised_greeting\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\user\Entity\User;
use Drupal;
/**
 * Provides a simple greeting block for user
 *
 * @Block(
 *   id = "personalised_greeting_block",
 *   admin_label = @Translation("Greeting block for users")
 * )
 */
class GreetingBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build(): array
  {
    $user = User::load(Drupal::currentUser()->id());
    $message = $user->get('field_user_greeting_message')->value;
    return [
      "#type" => "markup",
      "#markup" => $user->isAuthenticated() ?
        $message . Drupal::currentUser()->getAccountName() :
        'Hello. Please log in!'
    ];
  }
  public function getBaseId(): string
  {
    return 'greeting_block';
  }
}
