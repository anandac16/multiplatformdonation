@extends('layouts.app')

@section('content')
<div class="container">
    <center><h1>Welcome</h1></center>
    <h2>Introduction</h2>
    <p style="white-space:pre-wrap" id="introduction-text">
Welcome to <strong>Multi-Platform Donation Dashboard!</strong>
This platform provides a centralized solution for content creators and streamers to collect, manage, and display donations from various platforms such as Trakteer, Sociabuzz, Tako, and Saweria. With real-time widget overlays, customizable milestone and leaderboard views, and a seamless webhook bridge, this dashboard helps you engage your audience and track supporter contributions more efficiently.

Whether you're just starting out or already building a loyal community, this tool empowers you to unify your donation streams in one elegant and user-friendly interface.
    </p>

    <h2>Terms of Service</h2>
    <p style="white-space:pre-wrap" id="tos-text">
1. Acceptance of Terms
    By using this website or platform, you agree to be bound by these Terms of Service. If you do not agree, you must discontinue use of the service immediately.

2. Use of Services
    You agree to use the donation dashboard and its widgets solely for lawful purposes and in accordance with applicable platform guidelines (e.g. Trakteer, Sociabuzz, Tako, Saweria).

3. Account and UUID Management
    Each user is assigned a unique identifier (UUID) upon saving their webhook tokens.
    You are responsible for maintaining the confidentiality of your UUID and associated tokens.

4. Data Collection
    We collect donation-related data such as donor name, message, amount, and source platform for the purpose of displaying overlays and analytics. No sensitive personal or financial information is stored.

5. Webhooks and Security
    Webhook communication between your donation platforms and our system is secured via custom tokens and HMAC verification where applicable.
    Any unauthorized attempts to send or spoof webhook data may result in access restrictions.

6. Limitations
    We do not guarantee uptime, delivery, or performance of any third-party donation platforms. Our service is dependent on those platforms' APIs and webhook infrastructure.

7. Modifications to Service
    We reserve the right to modify, suspend, or discontinue the service at any time without prior notice.

8. Termination
    Violation of these terms may result in immediate suspension or termination of access to the platform and its widgets.

9. Changes to Terms
    These terms may be updated from time to time. Continued use of the platform constitutes acceptance of any modifications.
    </p>
</div>
@endsection
