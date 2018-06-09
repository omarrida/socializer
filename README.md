# Socializer

Automatically create social media post from Laravel models and post them via Buffer!

> Warning: This package has not been thoroughly tested and is still in development. Semantic versioning is not followed at this stage.

## Installation

```
composer require audiogram/socializer
```

Then publish the vendor files.

```
vendor:publish
```

Add your Buffer credentials to the `config/socializer.php` file.

```php
'buffer_credentials' => [
        'client_id'     => env('BUFFER_CLIENT_ID'),
        'client_secret' => env('BUFFER_CLIENT_SECRET'),
        'access_token'  => env('BUFFER_ACCESS_TOKEN'),
    ],

    'buffer_profile_ids' => [
        'facebook' => env('BUFFER_FACEBOOK_PROFILE_ID'),
        'twitter'  => env('BUFFER_TWITTER_PROFILE_ID'),
    ],
```

You should be all set now.

## Usage

Pick a model that you'd like to start creating social media posts for. In this example, we'll use a model called `Event` which might represent a local event listed on your app.

Simply add the `SocializableInterface` on your model and implement the `toSocializable()` method.

```php
use Illuminate\Database\Eloquent\Model;
use Audiogram\Socializer\SocializableInterface;

class Event extends Model implements SocializableInterface
{
  protected $fillable = ['name', 'location', 'image_url'];
  
  // ...
  
  public function toSocializable(): Audiogram\Socializer\Socializable
  {
    return (new Socializable())
      // Set the background image
      ->backgroundImagePath($this->image_url)
      // Set the image overlay text
      ->textOverlay($this->name)
      // Set the text for your post
      ->postText('Checkout our latest event ' . $this->name . ' taking place at ' . $this->location);
  }
}
```

Your model is now considered "socializable". To actually create a social media post and send it to Buffer, you can use this handy helper method. This is especially useful if you want to define an Eloquent event and call it from there. A good example is throwing an Eloquent event on model created where you pass the newly created model to the helper method and create a social media post on the fly.

```php
$event = Event::first();
socialize($event);
```

Congratulations! Your post has been created with the attached image and desired post text and sent to your Buffer account.

## Requirements

Socializer depends on the packages below.

```
intervention/image: ^2.4
guzzlehttp/guzzle: ^6.3
```

## Issues

If you find yourself stuck, encounter a bug, or have any questions/suggestions for improving this package, feel free to create an issue on GitHub and I'll try to address it as soon as possible.

## License

This project conforms to the MIT License (MIT).
