<!-- resources/views/emails/contact.blade.php -->

@component('mail::message')

# Nouveau message de contact

**Nom:** {{ $contactData['name'] }}

**Email:** {{ $contactData['email'] }}

**Message:**

{{ $contactData['message'] }}

@endcomponent
