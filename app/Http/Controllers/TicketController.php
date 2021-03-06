<?php
/*
 * Created by Beatific Angel
 *  20222/3/25 9.00am
 * */
namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Device;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TicketController extends Controller
{

    public function index()
    {
        $tickets = Ticket::paginate(10);

        return view('tickets.index', compact('tickets'));
    }


    public function create()
    {
        $customers = Customer::all();
        $devices = Device::all();
        return view('tickets.create', compact('customers','devices'));
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'customer_id' => 'required',
            'device_id' => 'required',
            'status' => 'required',
            'message' => 'required'
        ]);

        $ticket = new Ticket([
            'title' => $request->input('title'),
            'customer_id' => $request->input('customer_id'),
            'ticket_id' => strtoupper(Str::random(10)),
            'device_id' => $request->input('device_id'),
            'status' => $request->input('status'),
            'message' => $request->input('message')
        ]);

        $ticket->save();

        return redirect()->back()->with("success", "A ticket with ID: #$ticket->ticket_id has been opened.");
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'message' => 'required'
        ]);
        $ticket = Ticket::where('ticket_id', $request->ticket_id)->firstOrFail();

        $ticket->status = $request->status;
        $ticket->message = $request->message;
        $ticket->save();

        return redirect()->back()->with("success", "A ticket with ID: #$ticket->ticket_id has been updated.");
    }


    public function Edit($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

        return view('tickets.edit', compact('ticket'));
    }


    public function close($ticket_id)
    {

        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $ticket->status = "Closed";

        $ticket->save();

        return redirect()->back()->with("success", "The ticket has been closed.");
    }
    public function delete($id)
    {
        $ticket_query = "delete from tickets where id = '$id'";
        $ticket_query_res = DB::select($ticket_query);
        return redirect()->back()->with("success", "The Ticket has been deleted.");
    }
    public function print_ticket(Request $request)
    {
        $ticket_id = $request->ticket_id_print;
        $customer_id = $request->customer_id_print;
        $device_id = $request->device_id_print;
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $customer = Customer::where('id', $customer_id)->firstOrFail();
        $device = Device::where('id', $device_id)->firstOrFail();


        return view('tickets.printorder', compact('ticket','customer','device'));
    }
}
