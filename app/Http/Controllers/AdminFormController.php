<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormAttachment;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;
use App\Models\Reply;


class AdminFormController extends Controller
{
    //
    // public function adminshowform()
    // {
    //     $forms = Form::with('user', 'replies')->get();

    //     // ส่งข้อมูลไปยัง view
    //     return view('admin_show_form.admin_show_form', compact('forms'));
    // }
    public function adminshowform()
    {
        // ใช้ eager loading เพื่อโหลด attachments, user และ replies
        $forms = Form::with(['user', 'replies', 'attachments'])->get();

        // ส่งข้อมูลไปยัง view
        return view('admin_show_form.admin_show_form', compact('forms'));
    }


    public function edit($id)
    {
        $form = Form::with('attachments')->findOrFail($id); // ดึงข้อมูลฟอร์มพร้อมไฟล์แนบ

        return view('admin_form_edit.admin_form_edit', compact('form')); // ส่งข้อมูลไปยัง view
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'subject' => 'required|string|max:255',
            'guest_name' => 'required|string|max:255',
            'guest_age' => 'required|integer',
            'guest_phone' => 'required|string|max:20',
            'guest_house_number' => 'required|string|max:20',
            'guest_village' => 'required|string|max:50',
            'guest_subdistrict' => 'required|string|max:50',
            'guest_district' => 'required|string|max:50',
            'guest_province' => 'required|string|max:50',
            'request_details' => 'required|string',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // ค้นหาฟอร์มที่ต้องการอัปเดต
        $form = Form::findOrFail($id);

        // อัปเดตข้อมูลฟอร์ม
        $form->update([
            'date' => $request->date,
            'subject' => $request->subject,
            'guest_name' => $request->guest_name,
            'guest_age' => $request->guest_age,
            'guest_phone' => $request->guest_phone,
            'guest_house_number' => $request->guest_house_number,
            'guest_village' => $request->guest_village,
            'guest_subdistrict' => $request->guest_subdistrict,
            'guest_district' => $request->guest_district,
            'guest_province' => $request->guest_province,
            'request_details' => $request->request_details,
        ]);

        // ตรวจสอบว่าอัปโหลดไฟล์ใหม่หรือไม่
        if ($request->hasFile('attachments')) {
            // ค้นหาไฟล์เก่าที่มีอยู่ใน database
            $oldAttachments = FormAttachment::where('form_id', $form->id)->get();

            // ลบไฟล์เก่า
            foreach ($oldAttachments as $attachment) {
                // ลบไฟล์จาก storage
                Storage::disk('public')->delete($attachment->file_path);
                // ลบ record จาก database
                $attachment->delete();
            }

            // บันทึกไฟล์ใหม่
            foreach ($request->file('attachments') as $file) {
                // สร้างชื่อไฟล์ที่ไม่ซ้ำกัน
                $filename = time() . '_' . $file->getClientOriginalName();
                // เก็บไฟล์ใน public/storage/attachments
                $path = $file->storeAs('attachments', $filename, 'public');

                // สร้างบันทึกไฟล์ใหม่ใน database
                FormAttachment::create([
                    'form_id' => $form->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'ฟอร์มถูกอัปเดตเรียบร้อยแล้ว!');
    }

    public function exportPDF($id)
    {
        $form = Form::find($id);
        if (!$form) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลฟอร์ม');
        }

        // กำหนด Options สำหรับ Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // สร้าง instance ของ Dompdf
        $dompdf = new Dompdf($options);

        // โหลด view ที่ต้องการสร้าง PDF
        $html = view('admin_export_pdf.admin_export_pdf', compact('form'))->render();

        // โหลด HTML ลงใน Dompdf
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // ส่งไฟล์ PDF ไปยังเบราว์เซอร์
        return $dompdf->stream('แบบคำขอร้องทั่วไป' . $form->id . '.pdf', ['Attachment' => false]);

    }

    public function updateStatus($id)
    {
        $form = Form::findOrFail($id);

        // อัปเดตสถานะ
        $form->status = 2; // หรือค่าที่คุณต้องการ
        $form->admin_name_verifier = Auth::user()->name; // เก็บ fullname ของผู้ล็อกอิน
        $form->save();

        return redirect()->back()->with('success', 'คุณได้กดรับแบบฟอร์มเรียบร้อยแล้ว');
    }

    public function reply(Request $request, $formId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // dd($request);
        // dd(auth()->id());

        Reply::create([
            'form_id' => $formId,
            'user_id' => auth()->id(),
            'reply_text' => $request->message,
        ]);

        return redirect()->back()->with('success', 'ตอบกลับสำเร็จแล้ว!');
    }
}