<?php

// 设定文件来源路径，为当前目录下的 ./reference/canadiancim 目录
// 获取当前绝对路径
$root = dirname(__FILE__);
$file_root = ['reference', 'canadiancim'];
$document_root = arrayToPath([$root, arrayToPath($file_root)]);

// 收集 HTML 文件列表
$html_files = scandir_recursive($document_root);

// 遍历 HTML 文件列表
foreach ($html_files as $file) {
  // 调试模式，只处理一个文件
  // if ($file !== '\index.html') {
  //   continue;
  // }
  // 处理 HTML 文件中的链接和超阈值文本内容
  handleHtml($file, $file_root, $document_root);
}

/***********************************************/

/**
 * Summary of handleHtml
 * @param mixed $html
 * @param mixed $document_root
 * @return void
 * 处理 HTML 文件中的链接和超阈值文本内容
 */
function handleHtml($file, $file_root, $document_root)
{
  // 另存节点内容的长度阈值，超过阈值的内容将被另存为文件
  // 目前设定为 100 个字符
  $content_length_threshold = 500;

  // 去除 $file 的前导和末尾的 /
  $file = trim($file, DIRECTORY_SEPARATOR);
  // 将 $file 拆分成数组
  $file_array = explode(DIRECTORY_SEPARATOR, $file);
  // 移除最后一个元素
  array_pop($file_array);

  // 获取文件名，去除扩展名
  $html_name = pathinfo($file, PATHINFO_FILENAME);
  // 获取 HTML 文件路径
  $html_path = $document_root . DIRECTORY_SEPARATOR . $file;
  $html = file_get_contents($html_path);
  $links = array();
  $link_file_map = array();
  $content_map = array();
  $dom = new DOMDocument();
  libxml_use_internal_errors(TRUE);
  $dom->loadHTML($html);
  libxml_clear_errors();
  $xpath = new DOMXPath($dom);
  // 获取所有待处理的节点
  $nodes = [];

  // 获取所有带 data-url 属性的节点
  $nodes_data_url = $xpath->query('//*[@data-url]');
  // 获取节点中的 data-url 属性值
  foreach ($nodes_data_url as $node) {
    $link = $node->getAttribute('data-url');
    $links[] = $link;
    $url_array = urlToArray($link);
    $link_file_map[$link] = $url_array;
    // 获取节点中的文本内容
    $text = $node->textContent;
    // 保存在映射表中，键名为 data-url 属性值，键值为文本内容
    $content_map[$link] = $text;
    
    // 添加 defer 属性，表示该文件需要延迟加载
    $node->setAttribute('tmp-link', $link);

    $nodes[] = $node;
  }

  // 获取所有带 data-href 属性的节点
  $nodes_data_href = $xpath->query('//*[@data-href]');
  // 获取节点中的 data-url 属性值
  foreach ($nodes_data_href as $node) {
    $link = $node->getAttribute('data-href');
    $links[] = $link;
    $url_array = urlToArray($link);
    $link_file_map[$link] = $url_array;
    // 获取节点中的文本内容
    $text = $node->textContent;
    // 保存在映射表中，键名为 data-href 属性值，键值为文本内容
    $content_map[$link] = $text;
    
    $node->setAttribute('tmp-link', $link);

    $nodes[] = $node;
  }

  // application/json 文件的保存目录
  $application_json_root = '_application_json';
  // 获取所有 type="application/json" 的 script 节点
  $nodes_application_json = $xpath->query('//script[@type="application/json"]');
  // 获取节点中的文本内容
  foreach ($nodes_application_json as $node) {
    $text = $node->textContent;
    // 判断是否超出阈值
    if (strlen($text) > $content_length_threshold) {
      // 另存节点内容为文件
      // 获取节点的 id 属性值，并将其作为文件名
      $id = $node->getAttribute('id');
      // 生成文件名
      $filename = $id. '.js';
      // 生成文件路径
      $url_array = [ $application_json_root ];
      if (!empty($file_array)) {
        foreach ($file_array as $_tmp) {
          $url_array[] = $_tmp; 
        }
      }
      $url_array[] = $html_name;
      $url_array[] = $filename;
      $link = arrayToPath($url_array);
      // 将文件名和文件路径保存到映射表中
      $link_file_map[$link] = $url_array;

      // 将 ID 值转为驼峰命名法
      $new_id = str_replace('-', '', ucwords($id, '-'));
      // 将节点内容替换为变量名，挂载到 window 对象上
      $new_text = "window.{$new_id} =  {$text}";
      $content_map[$link] = $new_text;

      // 去除节点的 type 属性
      $node->removeAttribute('type');
      
      $node->setAttribute('tmp-link', $link);

      $nodes[] = $node;

      // 获取节点的下一个 script 节点
      $tmp = $node->nextSibling;
      $next_node = $tmp->nextSibling;
      if ($next_node && $next_node->nodeName === 'script') {
        // 获取节点的 textContent
        $next_text = $next_node->textContent;
        // 查找是否调用 application/json 节点的内容
        $pattern = "JSON.parse(document.getElementById('{$id}').textContent)";
        // 将调用语句替换为调用对应的变量名
        $new_next_text = str_replace($pattern, "window.{$new_id}", $next_text);
        // 将节点的 textContent 替换为修改后的内容
        $next_node->textContent = $new_next_text;
      }
    }

    // style 文件的保存目录
    $style_root = '_style';
    // 获取所有 无 data-url 属性的 style 节点
    $nodes_style = $xpath->query('//style[not(@data-url)]');
    // 获取节点中的文本内容
    foreach ($nodes_style as $node) {
      $text = $node->textContent;
      // 判断是否超出阈值
      if (strlen($text) > $content_length_threshold) {
        // 另存节点内容为文件
        // 获取节点的 id 属性值，并将其作为文件名
        $id = $node->getAttribute('id');
        // 如果没有 id 属性值，则使用 md5 函数生成文件名
        if (empty($id)) {
          $id = md5($text);
        }
        // 生成文件名
        $filename = $id. '.css';
        // 生成文件路径
        $url_array = [ $style_root ];
        if (!empty($file_array)) {
          foreach ($file_array as $_tmp) {
            $url_array[] = $_tmp;
          }
        }
        $url_array[] = $html_name;
        $url_array[] = $filename;
        $link = arrayToPath($url_array);
        // 将文件名和文件路径保存到映射表中
        $link_file_map[$link] = $url_array;
        $content_map[$link] = $text;

        $node->setAttribute('tmp-link', $link);
  
        $nodes[] = $node;
      }
    }
  }

  // 遍历 link_file_map，将每个 url_array 转成文件目录，并创建目录
  // 先创建一个数组，模拟文件目录结构
  $file_structure = array();
  foreach ($link_file_map as $link => $url_array) {
    $current_level = &$file_structure;
    foreach ($url_array as $level) {
      if (!isset($current_level[$level])) {
        $current_level[$level] = array();
      }
      $current_level = &$current_level[$level];
    }
  }
  // 遍历 file_structure，将每个数组元素转成文件目录，并创建目录
  createDirectory($file_structure, $document_root);

  // 按 link_file_map 中的 url_array，将 content_map 中的内容保存到文件中
  foreach ($link_file_map as $link => $url_array) {
    // 生成文件路径
    $file_path_array = array_merge([$document_root], $url_array);
    $file_path = arrayToPath($file_path_array);
    // 获取文件内容
    $content = $content_map[$link];
    // 将文件内容写入文件
    file_put_contents($file_path, $content);
  }

  // 替换 data-url 节点的 href 属性值，将其替换为文件路径，保存最终的 HTML 文件
  foreach ($nodes as $node) {
    // 清空 $node 的内容
    $node->nodeValue = '';
    // 判断 $node 的类型
    $link = $node->getAttribute('tmp-link');
    $file_path = $link_file_map[$link];
    $new_link = '/' . implode('/', $file_root)
      . '/' . implode('/', $file_path);
    if ($node->nodeName === 'script') {
      $node->setAttribute('src', $new_link);
    } else if ($node->nodeName === 'style') {
      $node->setAttribute('href', $new_link);
    }
  }
  // 输出最终的 HTML 文件
  // $html = $dom->saveHTML();
  // echo $html;
  // exit();

  // 保存最终的 HTML 文件
  $html = $dom->saveHTML();
  file_put_contents($html_path, $html);
  // 输出结果，列出 HTML 文件保存的路径
  echo 'HTML 文件已保存到：' . $html_path . PHP_EOL;
}


// 定义遍历目录的函数
/**
 * Summary of scandir_recursive
 * @param mixed $dir
 * @param mixed $files
 * @param mixed $ext
 * @return array
 * 递归遍历目录，获取所有指定扩展名的文件
 */
function scandir_recursive($root_dir, $relative_path = '', $files = [], $ext = 'html')
{
  if ($relative_path === '') {
    $dir = $root_dir;
  } else {
    $dir = $root_dir . $relative_path;
  }
  // 打开目录
  $handle = opendir($dir);
  // 循环读取目录中的文件
  while (false !== ($file = readdir($handle))) {
    // 排除 . 和 ..
    if ($file != '.' && $file != '..') {
      $file_path = $dir. DIRECTORY_SEPARATOR. $file;
      // 检查是否为目录
      if (is_dir($file_path)) {
        // 设置新的相对路径
        $new_relative_path = $relative_path. DIRECTORY_SEPARATOR. $file;
        // 递归调用函数
        $files = scandir_recursive($root_dir, $new_relative_path, $files, $ext);
      } else {
        // 判断文件扩展名是否为指定的扩展名
        if (pathinfo($file, PATHINFO_EXTENSION) === $ext) {
          // 将文件路径添加到数组中
          $files[] = $relative_path. DIRECTORY_SEPARATOR. $file;
        }
      }
    } 
  }
  return $files;
}

/**
 * Summary of createDirectory
 * @param mixed $file_structure
 * @param mixed $path
 * @return void
 * 创建目录
 */
function createDirectory($file_structure, $path)
{
  foreach ($file_structure as $key => $value) {
    if (!empty($value)) {
      $new_path = arrayToPath([$path, $key]);
      // 检查目录是否已存在
      if (!is_dir($new_path)) {
        // 创建目录
        mkdir($new_path);
      }
      // 如果当前元素是数组，则递归创建子目录
      createDirectory($value, $new_path);
    }
  }
}

/**
 * Summary of urlToArray
 * @param mixed $url
 * @return array
 * 将 URL 转成数组
 */
function urlToArray($url)
{
  // 去除 URL 中的协议部分
  $url = preg_replace('/^https?:\/\//', '', $url);
  // 去除 URL 中的参数部分
  $url = preg_replace('/\?.*/', '', $url);
  // 将 URL 按照 / 分割成数组
  $url_array = explode('/', $url);
  // 去除数组中的空元素
  $url_array = array_filter($url_array);
  // 返回处理后的 URL 数组
  return $url_array;
}

/**
 * Summary of arrayToPath
 * @param mixed $array
 * @return string
 * 将数组转成路径
 */
function arrayToPath($array)
{
  // 将数组元素按照 / 连接成字符串
  $path = implode(DIRECTORY_SEPARATOR, $array);
  return $path;
}

?>