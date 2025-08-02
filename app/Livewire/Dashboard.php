<?php

namespace App\Livewire;

use App\Models\Contact;
use App\Service\ContactService;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    public $search_name = '';
    public $search_email = '';
    public $search_phone = '';

    protected $queryString = [
        'search_name' => ['except' => ''],
        'search_email' => ['except' => ''],
        'search_phone' => ['except' => ''],
    ];

    protected $listeners = ['deleteContact' => 'delete'];
    public function delete($id, ContactService $contactService)
    {
        try {
            $contactService->delete($id);

            $this->dispatch('show-alert', [
                'title' => 'Sukses!',
                'message' => 'Kontak berhasil dihapus.',
                'type' => 'success',
            ]);
            $this->dispatch('play-success-sound');
        } catch (\Exception $e) {
            $this->dispatch('show-alert', [
                'title' => 'Ups!',
                'message' => 'Kontak gagal dihapus.',
                'type' => 'error',
            ]);
            $this->dispatch('play-error-sound');
        }
    }

    public function search()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['search_name', 'search_email', 'search_phone']);
    }

    public function render()
    {
        $contacts = Contact::with('addresses')
            ->where('username', auth()->user()->username)
            ->when($this->search_name, fn($query) => $query->where('first_name', 'like', "%{$this->search_name}%"))
            ->when($this->search_email, fn($query) => $query->where('email', 'like', "%{$this->search_email}%"))
            ->when($this->search_phone, fn($query) => $query->where('phone', 'like', "%{$this->search_phone}%"))
            ->paginate();

        return view('livewire.dashboard', compact('contacts'));
    }
}