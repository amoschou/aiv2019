<?php
  $activetab = NULL;
?>

@extends('layouts.base')

@section('cardtitle')
@stop


@section('featureblock')
@stop


@section('cellsupportingtext')

  <h3>{{ $titletext }}</h3>

  @if($titletext == 'Code of conduct')

    <p>This code of conduct has been in place at festivals for several years now and registrants should be familiar with it.</p>
    <h4>Objectives</h4>
    <p>The 70th Australian Intervarsity Choral Festival (AIV) is intended to be a fun and safe environment for all attendees. This code of conduct has been designed to:</p>
    <ul>
      <li>Clarify good conduct and inappropriate behaviour</li>
      <li>Explicate standards of behaviour expected of members of the Festival</li>
      <li>Provide options for managing inappropriate behaviour</li>
    </ul>
    <p>By attending the Festival you agree to comply with this Code of Conduct and accept its conditions. Please note that failure to comply with the Code of Conduct may result in ejection from the Festival at the discretion of the Festival Committee.</p>
    <h4>Definitions</h4>
    <h5>Good Conduct</h5>
    <p>All members of the Festival are expected to behave in a way that ensures other members are able to feel safe.</p>
    <p>Good conduct includes, but is not limited to:</p>
    <ul>
      <li>Respecting the rights of others;</li>
      <li>Behaving honestly and with integrity;</li>
      <li>Acting with care and diligence; and</li>
      <li>Treating others with respect and courtesy, without harassment.</li>
    </ul>
    <h5>Discrimination</h5>
    <p>Refers to the less favourable treatment of a person by another or others based on their actual or perceived membership in a certain group or category.</p>
    <p>This does not include cases where such treatment is required by law or is necessary for the safety of others.</p>
    <h5>Harassment</h5>
    <p>Refers to the repeated less favourable treatment of a person by another or others. This includes any persistent unwelcome behaviour, particularly unwarranted or invalid criticism, fault finding, exclusion or isolation. It can make participating in activities humiliating or intimidating for the individual or group targeted by this behaviour. The Festival does not tolerate any form of harassment.</p>
    <p>Harassment does not include differences of opinion or non-aggressive conflict.</p>
    <p>Behaviour will only be defined as harassment if an objective third party observing the situation would consider it to be harassment.</p>
    <h5>Violent Behaviour</h5>
    <p>Refers to behaviour that has or is likely to cause injury or damage to persons or property, whether such persons or property are affiliated with the Festival or not.</p>
    <h4>Principles of Good Behaviour</h4>
    <p>All members have the responsibility of ensuring that they behave with good conduct.</p>
    <p>Every member of the Festival can expect certain rights, and Good Conduct begins with respecting these rights. In particular, some basic principles should be taken into consideration, including the following.</p>
    <h5>Privacy</h5>
    <p>While AIV is a public event, recording events without the consent of the participants can make some people feel that their privacy has been violated. It is appropriate to ask permission before taking and uploading photographs to the Internet, quoting people on Social Media, etc.</p>
    <p>In addition, while some members may feel comfortable broaching delicate or personal subjects, others may not. It is appropriate to accept someone’s refusal to divulge information about themselves with good grace, and move on.</p>
    <h5>Personal Boundaries</h5>
    <p>People’s attitudes towards personal boundaries can vary widely. For example, while some people may be okay with hugs for greeting and casual physical contact, others may not. It is appropriate to ask permission before making contact with someone or coming very close to them.</p>
    <p>In particular, it may not always be clear when a long-standing relationship means that a person has implicit permission to enter another’s personal space. Even if someone is making contact with someone else, it is appropriate to ask before taking the same liberty.</p>
    <h5>Veracity</h5>
    <p>Where possible, honesty really is the best policy. False statements, particularly made about other people, can cause significant hurt to people in particular, and damage to the culture of the Festival as a whole. If you don’t know what to say, or don’t feel comfortable sharing the truth about something, it is appropriate to say nothing at all.</p>
    <h5>Encouragement</h5>
    <p>Intervarsity Choral Festivals bring together a wide range of people from a variety of different backgrounds, educational levels and knowledge. It is an opportunity for people of all skill levels to come together and learn as well as have fun. Even if someone does not have knowledge or skills that you have, it is appropriate to give friendly and honest feedback, and encourage the development of skills and talents.</p>
    <h4>Types of Inappropriate Behaviour</h4>
    <p>The following are some examples of specific types of inappropriate behaviour. This should not be taken as an exhaustive list.</p>
    <h5>Abuse of Drugs</h5>
    <p>While the consumption of alcohol may serve as a welcome means of relaxation and enjoyment for members, the abuse of alcohol by drinking to excess is inappropriate behaviour throughout the Festival.</p>
    <p>The possession or use of illicit drugs, or the illegal supply of drugs to minors, will not be tolerated. Immediate expulsion from the Festival and referral to relevant authorities will result.</p>
    <h5>Bullying</h5>
    <p>Bullying may be characterised as offensive, intimidating, malicious or insulting behaviour, an abuse or misuse of power through means intended to undermine, humiliate, denigrate or injure the recipient. Examples of bullying could be:</p>
    <ul>
      <li>Abuse of power or authority</li>
      <li>Verbal, written and/or physical intimidation e.g. threats, derisory remarks</li>
      <li>Persistent unjustified criticism</li>
      <li>Public humiliation</li>
      <li>The setting of impossible deadlines or intolerable workload burdens</li>
      <li>Having responsibilities or decision-making powers withdrawn without good reason or explanation</li>
      <li>Unwarranted exclusions</li>
    </ul>
    <p>Vigorous speech, comment or academic debate can be distinguished from bullying behaviour. In these situations, care should be taken to ensure that staff, volunteers and Festival members are not made to feel intimidated.</p>
    <p>The bullying of staff, volunteers or members of the Festival is inappropriate, and may result in expulsion from the Festival.</p>
    <h5>Sexual Harassment</h5>
    <p>Sexual harassment is defined as any form of unwanted verbal, non-verbal or physical conduct of a sexual nature that creates an intimidating, hostile, degrading or offensive environment. It may include:</p>
    <ul>
      <li>Physical contact</li>
      <li>Invasion of personal space</li>
      <li>Suggestive remarks or sounds</li>
      <li>Unwanted comments on dress and appearance</li>
      <li>Jokes of a sexual nature</li>
      <li>Display of sexually offensive material</li>
      <li>Inappropriate downloading of material</li>
      <li>Verbal threats</li>
    </ul>
    <p>It is important to remember that sexual harassment can occur towards women by men, men by women, and also between members of the same sex. It can also refer to unwanted conduct that is related to the sex of the other person.</p>
    <p>Sexual Harassment is taken very seriously by the Festival Committee, and may result in expulsion from the Festival.</p>
    <h5>Discrimination</h5>
    <p>Discrimination refers to the less favourable treatment of a person by another or others based on their actual or perceived membership in a certain group or category. In particular, it may include treatment based on a person’s actual or perceived:</p>
    <ul>
      <li>Age</li>
      <li>Race/Ethnicity</li>
      <li>Nationality</li>
      <li>Disability</li>
      <li>Sex</li>
      <li>Sexual Orientation</li>
      <li>Gender Identity</li>
      <li>Language</li>
      <li>Religious Belief or otherwise</li>
    </ul>
    <p>Restrictions imposed for legal or safety reasons, such as the restriction of certain events to members over the age of eighteen as required by Australian law, are legitimate. However, discrimination where no legitimate reason is present is inappropriate behaviour.</p>
    <p>Repeated discrimination constitutes harassment, and may result in expulsion from the Festival.</p>
    <h5>Violent and threatening behaviour</h5>
    <p>Violent behaviours or threats of violence, including to persons, property or self, are a significant risk to the Festival and its members.</p>
    <p>As such, a no-tolerance policy applies to violence or threats of violence, and appropriate authorities may be engaged at the discretion of the Festival.</p>
    <h4>Equity Officers</h4>
    <p>If a member feels harassed or discriminated against, and they feel comfortable doing so, they may ask the person to stop or make it clear that their behaviour is unwelcome.</p>
    <p>In order to deal with cases where this is not sufficient, however, the Festival Committee shall appoint Equity Officers, who shall serve as a point of contact during the Festival. Contact details for the Equity Officers shall be made available to all members of the Festival.</p>
    <p>When appointing Equity Officers, care will be taken to ensure that they are (as much as is practicable) sensible, respected and approachable members of the broader IV community. The Officers shall not be members of the Festival Committee.</p>
    <p>The Officers have the full support of the Festival Committee in all aspects of their role, however the Committee may remove an Equity Officer where warranted.</p>
    <p>The Equity Officers may take whatever action they deem practicable to deal with complaints of inappropriate behaviour. This may include discussing the inappropriate behaviour with both parties with an aim to find an amicable solution.</p>
    <p>If, in the opinion of the Equity Officers, inappropriate behaviour is unlikely to be manageable amicably, they may recommend to the Festival Committee that a person be ejected from the Festival.</p>

  @elseif ($titletext == 'Summary of the privacy policy')
  
    <p>The privacy level is P3.</p>
    <p>This is a summary of (and not a substitute for) the <a href="/privacy">full privacy policy</a>.</p>
    <p>This website collects the following types of information:</p>
    <ul>
      <li>personal</li>
      <li>financial</li>
      <li>medical</li>
      <li>sensitive</li>
      <li>sharing</li>
    </ul>
    <p>On this website:</p>
    <ul>
      <li>We collect information such as financial details and encrypt it for the highest level of protection.</li>
      <li>We only disclose it to others for the purposes that you would expect.</li>
    </ul>
    <h4>Note</h4>
    <p>If you wish, you can contact the person responsible for privacy on this Web site. <a href="/contact">https://www.aiv.org.au/contact</a>.</p>
    <p>Where personal information is collected:</p>
    <ul>
      <li>It is only held while you are a customer, or for any extra period required by law.</li>
      <li>You are able to amend or delete your personal information held by the site. <a href="/account">https://www.aiv.org.au/account</a>.</li>
    </ul>
    <p>Where personal information is disclosed to others:</p>
    <ul>
      <li>You can see where the information will go. <a href="/privacy/affiliates">https://www.aiv.org.au/privacy/affiliates</a>.</li>
    </ul>

  @elseif ($titletext == 'Privacy policy')

    <h4>About this policy</h4>
    <h5>Purpose</h5>
    <p>The purpose of this privacy policy is to communicate clearly the personal information handling practices we follow when we collect and deal with your personal information, including how you can contact us if you wish to correct or access personal information we hold about you.</p>
    <h5>Privacy Act 1988 (Cth)</h5>
    <p>As a small business, we are exempted from the operation of the Privacy Act. However, protection of your personal information that we collect is very important to us. This policy sets out how we handle any personal information we collect or receive about you.</p>
    <p>The Privacy Act 1988 (Cth) can be viewed at <a href="http://www.austlii.edu.au/au/legis/cth/consol_act/pa1988108/">http://www.austlii.edu.au/au/legis/cth/consol_act/pa1988108/</a>.</p>
    <h5>How is our privacy policy structured?</h5>
    <p>Our privacy policy is ‘layered’ as it is presented in three layers. The first layer is the Privacy icon shown on the bottom of the web page in which we collect your personal information. It provides a quick snapshot of our information handling practices. The second layer, the one page summary that you reach from the icon link, provides you with a summary of how we collect, use, disclose and store your personal information, how you can contact us and which Act applies to our activities. The third layer is this full privacy policy that provides a more detailed explanation of our information handling procedures.</p>
    <h4>Our personal information handling practices</h4>
    <h5>What is personal information?</h5>
    <p>We use the definition of personal information contained in s 6(1) of the Privacy Act. It states that personal information is ‘information or an opinion (including information or an opinion forming part of a database), whether true or not, and whether recorded in a material form or not, about an individual whose identity is apparent, or can reasonably be ascertained, from the information or opinion’.</p>
    <h5>Collection of personal information</h5>
    <p>We try to collect personal information directly from the individual.</p>
    <p>We only collect personal information for purposes which are directly related to our activities and only when it is necessary for or directly related to such purposes. These purposes include:</p>
    <ul>
      <li>To provide you with information you have enquired about</li>
      <li>To provide you with goods you have purchased</li>
      <li>To provide you with services you have purchased</li>
      <li>When you ask to be on an email or mailing list so that we can send you information about our activities and/or publications</li>
      <li>When you send us information about an event you are organising for us to publicise on our website</li>
      <li>For normal communication processes when we might email you, text you or phone you</li>
    </ul>
    <h6>Browsing</h6>
    <p>When you only browse the website, we do not collect your personal information.</p>
    <p>When you look at our website, our internet service provider makes a record of your visit and logs (in server logs) the following information for statistical purposes:</p>
    <ul>
      <li>Your server address</li>
      <!--
      <li>Your top level domain name (for example .com, .gov, .org, .au, etc)</li>
      -->
      <li>The pages you accessed and documents downloaded</li>
      <li>The date and time of your visit to our site</li>
      <li>Whether you have visited our site before</li>
      <li>The previous site you visited, and</li>
      <li>The type of browser being used.<li>
    </ul>
    <p>We do not identify you or your browsing activities except, in the event of an investigation, where a law enforcement agency may exercise a warrant to inspect the internet service provider’s server logs.</p>
    <h6>Cookies</h6>
    <p>Our website may use cookies. You may choose to disable cookies in your browser but this may affect your use of the site in some areas.</p>
    <h5>Use and disclosure of your personal information</h5>
    <p>We disclose personal information to third parties. A list of these third parties can be found at <a href="{{ route('privacy.affiliates') }}">{{ route('privacy.affiliates') }}</a>. We only use personal information for the purposes for which it was given to us, or for purposes which are directly related to one of our activities, and we do not give it to other organisations or anyone else unless one of the following applies:</p>
    <ul>
      <li>You have consented</li>
      <li>You would reasonably expect, or have been told, that information of that kind is usually passed to those individuals or organisations so that, for example, your purchase can be sent to you by a postal service or delivery organisation</li>
      <li>It is required or authorised by law</li>
      <li>It will prevent or lessen a serious and imminent threat to somebody’s life or health</li>
      <li>It is reasonably necessary for the enforcement of the criminal law or of a law imposing a pecuniary penalty, or for the protection of public revenue.</li>
    </ul>
    <h5>Data quality</h5>
    <p>We take steps to ensure that the personal information we collect is accurate, up to date and complete. These steps include maintaining and updating personal information when we are advised by you that your personal information has changed.</p>
    <h5>Data security</h5>
    <p>We take steps to protect the personal information we hold against loss, unauthorised access, use, modification or disclosure and against other misuse. These steps include password protection for electronic files, encryption, securing paper files in locked cabinets and physical access restrictions.</p>
    <p>If you choose to join our email lists, complete online forms or lodge enquiries, your contact details are stored on password-protected databases.</p>
    <h5>Deletion of data and unsubscribing</h5>
    <p>When you cease to be a member of our website, we will destroy your personal information in a secure manner or delete it. If you have not purchased goods, services or visited our website for six months we will delete your information. You can request that your personal information be deleted at any time.</p>
    <p>You may also request us to delete any personal information we hold about you by emailing our contact person whose details are below. You may choose to opt out of further contact from us by sending us an email containing the word ‘unsubscribe’ in the title of the email.</p>
    <h5>Access and correction</h5>
    <p>If you wish to request access to the personal information we hold about you, or request that we change that personal information, we will allow access or make the changes unless we consider that there is a sound reason to withhold the information under relevant law such as the Privacy Act, Freedom of Information Act 1982 (Cth) (FOI Act) or other relevant information.</p>
    <p>You can obtain further information about how to request access or changes to the information we hold about you by contacting us (see details below).</p>
    <h5>How to contact us</h5>
    <p>You can obtain further information in relation to this privacy policy, ask questions about it or provide any comments, by contacting us:</p>
    <p><a href="{{ route('contact') }}">{{ route('contact') }}</a></p>

  @elseif ($titletext == 'Affiliates')

    <p>We disclose personal information to third parties for the purposes that you would expect. Where personal information is disclosed to others, you can see where the information will go here.</p>
    <p>As our events are organised, we will update this page to keep you informed on where your personal information goes. Some examples are:</p>
    <ul>
      <li>We use <a href="https://stripe.com/au">Stripe</a> to manage online payments. Please visit <a href="https://stripe.com/au/privacy">https://stripe.com/au/privacy</a> for more information.</li>
      <li>Your details are passed to the postal service or a delivery organisation so that your purchases can be sent to you.</li>
      <li>Your details are passed to caterers who are providing your meals.</li>
      <li>In billeting arrangements, hosts’ details are provided to guests and guests’ details are provided to hosts.</li>
    </ul>
    <p>See also our full <a href="{{ route('privacy') }}">privacy policy</a>.</p>

  @elseif ($titletext == 'Help')
  
    <p>
      We use a number of external services to manage our site, including emailing, text messaging and processing card payments. If one component of this site is not working, please check the status of the service at:
      <ul>
        <li><a href="http://status.nearlyfreespeech.net">http://status.nearlyfreespeech.net</a> for site hosting managed by <a href="https://www.nearlyfreespeech.net">NearlyFreeSpeech.NET</a></li>
        <li><a href="https://status.stripe.com">https://status.stripe.com</a> for online payments managed by <a href="https://stripe.com/au">Stripe</a></li>
        <li><a href="https://status.mailgun.com">https://status.mailgun.com</a> for emailing managed by <a href="https://www.mailgun.com">Mailgun</a></li>
        <li><a href="https://dev.telstra.com/status">https://dev.telstra.com/status</a> for text messaging managed by <a href="https://dev.telstra.com">Telstra API</a></li>
      </ul>
      and try again when it is available.
    </p>

  @endif

@stop

