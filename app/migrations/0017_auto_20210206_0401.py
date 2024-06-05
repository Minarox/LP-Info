# Generated by Django 3.1.4 on 2021-02-06 03:01

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        ("app", "0016_auto_20210206_0359"),
    ]

    operations = [
        migrations.RemoveField(
            model_name="user",
            name="address",
        ),
        migrations.AddField(
            model_name="address",
            name="user",
            field=models.ForeignKey(
                default="", on_delete=django.db.models.deletion.CASCADE, to="app.user"
            ),
        ),
    ]
