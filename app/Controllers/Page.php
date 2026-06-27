<?php
namespace App\Controllers;
class Page extends BaseController
{
 public function about()
 {
 return view('about', [
 'title' => 'Halaman Abot',
 'content' => 'Ini adalah halaman abaut yang menjelaskan tentang isi
halaman ini.'
 ]);

 }
 public function contact()
 {
 return view('contact', [
            'title' => 'Halaman Contact',
            'content' => 'Ini adalah halaman Contact'
        ]);
 }
 public function faqs()
 {
 return view('faqs', [
            'title' => 'Halaman FAQ',
            'content' => 'Ini adalah halaman FAQ'
        ]);
 }
public function tos()
{
  return view('tos', [
        'title' => 'Terms of Services',
        'content' => 'Ini halaman Term of Services'
    ]);
} 
}