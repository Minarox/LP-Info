# Generated by Django 3.1.4 on 2021-02-06 12:09

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ("app", "0018_auto_20210206_0402"),
    ]

    operations = [
        migrations.AlterField(
            model_name="product",
            name="created_at",
            field=models.DateTimeField(auto_now_add=True),
        ),
        migrations.AlterField(
            model_name="user",
            name="created_at",
            field=models.DateTimeField(auto_now_add=True),
        ),
    ]