@extends('layouts.app')

@section('title', 'Events') {{-- or Sermons / Give --}}
@section('content')

<section>
    <div style="text-align:center;margin-bottom:3rem;">
        <h1>About House of Hope Leeds</h1>
        <p style="font-size:1.1rem;color:#3A6EA5;font-weight:500;">A community of believers committed to faith, hope, and love</p>
    </div>
    
    <div style="max-width:800px;margin:0 auto;margin-bottom:3rem;">
        <p>
            House of Hope Leeds is a vibrant community of believers dedicated to following Jesus Christ and spreading His love throughout our community. We are a welcoming fellowship where people from all backgrounds can experience the grace, hope, and transformation found in a personal relationship with God.
        </p>
        <p>
            Our church family is committed to living out the values of faith, compassion, and service. We believe in the power of community and the importance of growing together spiritually while supporting one another through life's journey.
        </p>
    </div>
</section>

<section style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;margin-bottom:3rem;">
    <div class="card">
        <h3 style="color:#3A6EA5;border-bottom:3px solid #DAA520;padding-bottom:0.5rem;">📖 Our Mission</h3>
        <p>
            To lead people into a growing relationship with Jesus Christ through worship, fellowship, discipleship, and service. We exist to transform lives and communities through the Gospel.
        </p>
    </div>
    
    <div class="card">
        <h3 style="color:#3A6EA5;border-bottom:3px solid #DAA520;padding-bottom:0.5rem;">✨ Our Vision</h3>
        <p>
            To be a beacon of hope in Leeds and beyond—a church known for authentic faith, radical love, and Christ-centered service that inspires and impacts our community for eternity.
        </p>
    </div>
</section>

<section>
    <h2 style="text-align:center;margin-bottom:2rem;">Our Core Values</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:1.5rem;">
        <div class="card" style="text-align:center;">
            <div style="font-size:2.5rem;margin-bottom:0.5rem;">❤️</div>
            <h4 style="color:#3A6EA5;margin-bottom:0.5rem;">Love</h4>
            <p style="margin:0;">We love God and love one another as Christ commanded us.</p>
        </div>
        
        <div class="card" style="text-align:center;">
            <div style="font-size:2.5rem;margin-bottom:0.5rem;">🕯️</div>
            <h4 style="color:#3A6EA5;margin-bottom:0.5rem;">Hope</h4>
            <p style="margin:0;">We believe in the transforming power of hope found in Christ.</p>
        </div>
        
        <div class="card" style="text-align:center;">
            <div style="font-size:2.5rem;margin-bottom:0.5rem;">🤝</div>
            <h4 style="color:#3A6EA5;margin-bottom:0.5rem;">Community</h4>
            <p style="margin:0;">We grow together, support each other, and serve our community.</p>
        </div>
    </div>
</section>
@endsection
