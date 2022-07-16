<?php

namespace App\Helper;

class Recusive
{

    public function RecusiveCat($cats, $parent, $url, $pd = 0, $text = '', $level = 0)
    {
        $RecusiveCat = array();
        foreach ($cats as $cat) {
            if ($cat['parent_id'] == $parent) {
                $RecusiveCat[] = $cat;
                $cat['level'] = $level;

                $cat['render_checkbox'] =
                    '<div class="item-check" style="margin-left:' . $pd * $level . 'px">' .
                    '<input type="checkbox" id="vehicle' . $cat['id'] . '" name="catId[]" value="' . $cat['id'] . '">' .
                    '<label style="margin-left: 5px" for="vehicle' . $cat['id'] . '" class="form-check-label">' . $cat['title']  . '</label><br>' .
                    '</div>';
                $cat['render_select'] = '<option value="' . $cat['id'] . '">' . str_repeat($text, $level) . " " . $cat['title'] . '</option>';
                $cat['render_table'] =
                    '<tr class="item-more cat-tr" >' .
                    '<td class="cat-title">
                            <p>' . str_repeat($text, $level) . " "  . $cat['title'] . ' (' . $cat['numberProdct'] . ')' . '</p>
                        </td>' .
                    '<td>
                        <div class="box-action dl-flex">
                            <a href="edit-cat-' . $url . '/' . $cat['id'] . '">
                                <p class="btn btn-edit btn-pr">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                </p>
                            </a>
                            <a href="delete-cat-' . $url . '/' . $cat['id'] . '">
                                <p class="btn btn-delete btn-se">
                                        <i class="fa-solid fa-trash-can"></i>
                                </p>
                            </a>
                            <a href="' . $cat['slug'] . '" target="_blank">
                                <p class="btn btn-eye btn-su">
                                    <i class="fa-solid fa-eye"></i>  
                                </p>
                            </a> 
                        </div>
                    </td>' .
                    '</tr>';

                $child =  $this->RecusiveCat($cats, $cat['id'], $url, $pd += 10, $text = '-', $level + 1);
                $RecusiveCat = array_merge($RecusiveCat, $child);
            }
        }
        return $RecusiveCat;
    }
}
