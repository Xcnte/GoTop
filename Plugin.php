<?php
/**
 * 页面顶部出现悬挂喵~点击触发至顶功能
 *
 * @package GoTop
 * @author Xcnte
 * @version 1.3.0
 * @link https://www.xcnte.com/
 */

class GoTop_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate() {
        Typecho_Plugin::factory('Widget_Archive')->header = array('GoTop_Plugin', 'header');
        Typecho_Plugin::factory('Widget_Archive')->footer = array('GoTop_Plugin', 'footer');
    }

   /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate() {

    }
    
    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        // 插件信息与更新检测
        function plugins_info($version)
        {
            echo "<style>.info{text-align:center; margin:20px 0;} .info > *{margin:0 0 15px} .buttons a{background:#467b96; color:#fff; border-radius:4px; padding: 8px 10px; display:inline-block;}.buttons a+a{margin-left:10px}</style>";
            echo "<div class='info'>";
            echo "<h2>GoTop返回顶部插件 (" . $version . ")</h2>";
            echo "<p>By: <a href='https://github.com/Xcnte'>Xcnte</a></p>";
            echo "<p class='buttons'><a href='https://www.xcnte.com/archives/887/'>插件说明</a>";
            echo "<p>感谢使用！更多说明请点击插件说明或<a href='https://github.com/Xcnte/GoTop'>点击前往github查看</a>~</p>";

            echo "</div>";
        }
        plugins_info("1.3.0");
        
        // 读取模型文件夹
        $chooseModels = array();
        $load = glob("../usr/plugins/GoTop/images/*");
        foreach ($load as $key => $value) {
            $single = substr($value, 28);
            $single = str_replace(strrchr($single, "."),"",$single); 
            $chooseModels[$single] = "<img style='max-height:300px;' src=$value alt=$single />";
        };

        // 选择模型
        $model = new Typecho_Widget_Helper_Form_Element_Radio(
            'model',
            $chooseModels,
            'reimu.png',
            _t('选择模型'),
            _t('选择一个你喜欢的模型。')
        );
        $form->addInput($model);
    }
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){

    }


    
    /**
     * 页头输出相关代码
     *
     * @access public
     * @param unknown header
     * @return unknown
     */
    public static function header() {
        $Path = Helper::options()->pluginUrl . '/GoTop/';
        $options = Helper::options()->plugin('GoTop');
        $model = $options->model;
        echo '<link rel="stylesheet" type="text/css" href="' . $Path . 'css/' . $model . '.css" />';
    }


    /**
     * 页脚输出相关代码
     *
     * @access public
     * @param unknown footer
     * @return unknown
     */
    public static function footer() {
        $Path = Helper::options()->pluginUrl . '/GoTop/';
        echo '<div class="back-to-top cd-top faa-float animated cd-is-visible" style="top: -900px;"></div>';
        echo '<script type="text/javascript" src="' . $Path . 'js/szgotop.js"></script>';
    }

}
