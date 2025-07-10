   function date_time_format(dateString)
    {

            const date = new Date(dateString.replace(" ", "T"));
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            };

        return formatted = date.toLocaleString('en-US', options);
    }