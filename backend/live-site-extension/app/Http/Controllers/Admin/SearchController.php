<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Consultation;
use App\Models\DomainDetail;
use App\Models\NewsletterSubscriber;
use App\Models\Order;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected const PER_SECTION = 8;

    public function index(Request $request)
    {
        $query = trim((string) $request->query('q', ''));

        if ($query === '') {
            return view('admin.search.results', ['query' => $query, 'results' => []]);
        }

        $like = '%' . $query . '%';

        $results = [
            'Users' => [
                'route' => 'admin.users',
                'items' => User::where(fn ($q) => $q->where('name', 'like', $like)->orWhere('email', 'like', $like))
                    ->limit(self::PER_SECTION)
                    ->get()
                    ->map(fn ($u) => [
                        'title' => $u->name,
                        'subtitle' => $u->email,
                        'url' => route('admin.users.edit', $u->id),
                    ]),
            ],
            'Blog Posts' => [
                'route' => 'admin.blogs.index',
                'items' => Blog::where(fn ($q) => $q->where('title', 'like', $like)
                        ->orWhere('category', 'like', $like)
                        ->orWhere('author', 'like', $like))
                    ->limit(self::PER_SECTION)
                    ->get()
                    ->map(fn ($b) => [
                        'title' => $b->title,
                        'subtitle' => $b->category . ' · ' . $b->author,
                        'url' => route('admin.blogs.index'),
                    ]),
            ],
            'Contact Enquiries' => [
                'route' => 'admin.contacts.index',
                'items' => Contact::where(fn ($q) => $q->where('first_name', 'like', $like)
                        ->orWhere('last_name', 'like', $like)
                        ->orWhere('email', 'like', $like)
                        ->orWhere('message', 'like', $like))
                    ->limit(self::PER_SECTION)
                    ->get()
                    ->map(fn ($c) => [
                        'title' => $c->first_name . ' ' . $c->last_name,
                        'subtitle' => $c->email,
                        'url' => route('admin.contacts.index'),
                    ]),
            ],
            'Consultations' => [
                'route' => 'admin.consultations.index',
                'items' => Consultation::where(fn ($q) => $q->where('name', 'like', $like)
                        ->orWhere('email', 'like', $like)
                        ->orWhere('subject', 'like', $like))
                    ->limit(self::PER_SECTION)
                    ->get()
                    ->map(fn ($c) => [
                        'title' => $c->name,
                        'subtitle' => $c->subject,
                        'url' => route('admin.consultations.index'),
                    ]),
            ],
            'Orders' => [
                'route' => 'admin.orders.index',
                'items' => Order::where(fn ($q) => $q->where('customer_name', 'like', $like)
                        ->orWhere('customer_email', 'like', $like)
                        ->orWhere('service_name', 'like', $like))
                    ->limit(self::PER_SECTION)
                    ->get()
                    ->map(fn ($o) => [
                        'title' => $o->customer_name . ' — ' . $o->service_name,
                        'subtitle' => ucfirst(str_replace('_', ' ', $o->status)),
                        'url' => route('admin.orders.show', $o->id),
                    ]),
            ],
            'Portfolio' => [
                'route' => 'admin.portfolio.index',
                'items' => Portfolio::where(fn ($q) => $q->where('title', 'like', $like)
                        ->orWhere('category', 'like', $like))
                    ->limit(self::PER_SECTION)
                    ->get()
                    ->map(fn ($p) => [
                        'title' => $p->title,
                        'subtitle' => $p->category,
                        'url' => route('admin.portfolio.index'),
                    ]),
            ],
            'Newsletter Subscribers' => [
                'route' => 'admin.newsletter.index',
                'items' => NewsletterSubscriber::where('email', 'like', $like)
                    ->limit(self::PER_SECTION)
                    ->get()
                    ->map(fn ($n) => [
                        'title' => $n->email,
                        'subtitle' => null,
                        'url' => route('admin.newsletter.index'),
                    ]),
            ],
            'Domains' => [
                'route' => 'admin.domains.index',
                'items' => DomainDetail::where('domain_name', 'like', $like)
                    ->limit(self::PER_SECTION)
                    ->get()
                    ->map(fn ($d) => [
                        'title' => $d->domain_name,
                        'subtitle' => null,
                        'url' => route('admin.domains.index'),
                    ]),
            ],
        ];

        // Drop sections with no matches so the results page only shows what's relevant
        $results = array_filter($results, fn ($section) => $section['items']->isNotEmpty());

        return view('admin.search.results', compact('query', 'results'));
    }
}
