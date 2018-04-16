---
layout: page
title: PDF Stamper
permalink: /extensions/pdf-stamper/
collection: extensions
category: extensions
---

<ul>
{% for item in site.extensions %}
    {% if item.category == 'pdf-stamper' %}
      <li><a href="{{ item.url }}">{{ item.title }}</a>
        - {{ item.description }}
      </li>
  {% endif %}
{% endfor %}
</ul>