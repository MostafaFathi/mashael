<!DOCTYPE html>

<html>

<head>

    <title>مشاعل العقيل - Mashael Aloqiel</title>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>

<body style="background: url(https://www.coachmashael.com/mashael/images/back-e.png)no-repeat;background-size: cover;text-align: center;">



<a href="https://www.coachmashael.com" style="text-align: center;display: inline-block;margin-bottom: 20px;">

    <img width="140" src="https://www.coachmashael.com/mashael/images/logofooter.png">

</a>
<br>


    {{-- Greeting --}}
    @if (! empty($greeting))
         {{ $greeting }}
    @else
        @if ($level === 'error')
             @lang('Whoops!')
        @else
             @lang('Hello!')
        @endif
    @endif

    {{-- Intro Lines --}}
    @foreach ($introLines as $line)
        {{ $line }}

    @endforeach

    {{-- Action Button --}}
    @isset($actionText)
        <?php
        switch ($level) {
            case 'success':
            case 'error':
                $color = $level;
                break;
            default:
                $color = 'primary';
        }
        ?>
        @component('mail::button', ['url' => $actionUrl, 'color' => $color])
            {{ $actionText }}
        @endcomponent
    @endisset

    {{-- Outro Lines --}}
    @foreach ($outroLines as $line)
        {{ $line }}

    @endforeach

    {{-- Salutation --}}
    @if (! empty($salutation))
        {{ $salutation }}
    @else
        @lang('Regards'),<br>
        {{ config('app.name') }}
    @endif

    {{-- Subcopy --}}
    @isset($actionText)
        @slot('subcopy')
            @lang(
                "If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
                'into your web browser: [:actionURL](:actionURL)',
                [
                    'actionText' => $actionText,
                    'actionURL' => $actionUrl,
                ]
            )
        @endslot
    @endisset





</body>

</html>
