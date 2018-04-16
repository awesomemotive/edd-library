---
layout: page
title: Checkout
permalink: /checkout/
category: checkout
---

<ul>
{% for item in site.checkout %}
  <li><a href="{{ item.url }}">{{ item.title }}</a>
    - {{ item.description }}
  </li>
{% endfor %}
</ul>